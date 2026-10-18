from zipfile import ZipFile, ZIP_DEFLATED
from lxml import etree as E
from copy import deepcopy
import re
from pathlib import Path
src=Path('output/dossier_projet/Aureo_Ruffier_Dossier_Projet_DWWM.docx')
out=src.with_name(src.stem+'_revise.docx')
W='http://schemas.openxmlformats.org/wordprocessingml/2006/main'; ns={'w':W}
def q(s): return '{'+W+'}'+s
def el(tag,**attrs):
 x=E.Element(q(tag))
 for k,v in attrs.items(): x.set(q(k),str(v))
 return x
def child(p,tag):
 x=p.find(q(tag))
 if x is None: x=el(tag);p.append(x)
 return x
def val(p,tag,v): child(p,tag).set(q('val'),str(v))
def txt(p): return ''.join(p.xpath('.//w:t/text()',namespaces=ns))
def font(p):
 f=child(p,'rFonts'); f.attrib.clear()
 for a in ['ascii','hAnsi','eastAsia','cs']: f.set(q(a),'Calibri')
def strip_prefix(p,pattern):
 m=re.match(pattern,txt(p))
 if not m:return
 left=m.end()
 for t in p.iter(q('t')):
  n=min(left,len(t.text or ''));t.text=(t.text or '')[n:];left-=n
  if not left:break
with ZipFile(src) as z: data={i.filename:z.read(i.filename) for i in z.infolist()}
d=E.fromstring(data['word/document.xml']);styles=E.fromstring(data['word/styles.xml']);nums=E.fromstring(data['word/numbering.xml']);settings=E.fromstring(data['word/settings.xml'])
body=d.find(q('body'));ps=body.findall(q('p'))
styles_map={x.get(q('styleId')):x for x in styles.findall(q('style'))}
aid=max(int(x.get(q('abstractNumId'))) for x in nums.findall(q('abstractNum')))+1
nid=max(int(x.get(q('numId'))) for x in nums.findall(q('num')))+1
a=el('abstractNum',abstractNumId=aid);val(a,'multiLevelType','multilevel')
for level,sid in enumerate(['Titre1','Titre2']):
 l=el('lvl',ilvl=level);a.append(l);val(l,'start',1);val(l,'numFmt','decimal')
 if level:val(l,'lvlRestart',1)
 val(l,'pStyle',sid);val(l,'suff','space');val(l,'lvlText','%1' if level==0 else '%1.%2');val(l,'lvlJc','left')
 font(child(l,'rPr'))
 pp=child(styles_map[sid],'pPr');np=child(pp,'numPr');val(np,'ilvl',level);val(np,'numId',nid)
 font(child(styles_map[sid],'rPr'))
nums.insert(len(nums.findall(q('abstractNum'))),a)
n=el('num',numId=nid);val(n,'abstractNumId',aid);nums.append(n)
# Keep unnumbered front matter and appendix headings independent of chapter numbering.
for sid,base,outline in [('SommaireTitre','Titre1',9),('AnnexeTitre','Titre1',0),('SousTitreNonNumerote','Titre2',9)]:
 s=el('style',type='paragraph',customStyle=1,styleId=sid);val(s,'name',sid);val(s,'basedOn',base)
 pp=child(s,'pPr');val(pp,'outlineLvl',outline);val(child(pp,'numPr'),'numId',0);font(child(s,'rPr'));styles.append(s)
for level in [1,2]:
 sid='TOC'+str(level);s=el('style',type='paragraph',styleId=sid);val(s,'name','toc '+str(level));val(s,'basedOn','Normal')
 pp=child(s,'pPr');sp=child(pp,'spacing');sp.set(q('after'),'120');sp.set(q('line'),'240');sp.set(q('lineRule'),'auto')
 child(pp,'ind').set(q('left'),'0' if level==1 else '280')
 tabs=child(pp,'tabs');tabs.append(el('tab',val='right',leader='dot',pos=9648))
 rp=child(s,'rPr');font(rp);val(rp,'sz',21)
 if level==1:val(rp,'b',1)
 styles.append(s)
chapter=sub=0;mapping={};heading_map={}
for p in ps[65:]:
 pp=p.find(q('pPr'));st=pp.find(q('pStyle')) if pp is not None else None
 if st is None:continue
 sid=st.get(q('val'));old=txt(p)
 if sid=='Titre1':
  if old.startswith('Annexe '):st.set(q('val'),'AnnexeTitre');heading_map[old]=p;continue
  chapter+=1;sub=0;strip_prefix(p,r'^[IVXLCDM]+\s+');mapping[old]=str(chapter)+' '+txt(p);heading_map[old]=p
 elif sid=='Titre2':
  if re.match(r'^\d+\s',old):
   sub+=1;strip_prefix(p,r'^\d+\s+');mapping[old]=f'{chapter}.{sub} '+txt(p);heading_map[old]=p
  else:st.set(q('val'),'SousTitreNonNumerote')
# Bookmarks for real clickable TOC entries.
bid=max([int(x.get(q('id'))) for x in d.iter(q('bookmarkStart'))]+[0])+1
anchors={}
for old,p in heading_map.items():
 name=f'_TocRevised{bid}';anchors[old]=name
 p.insert(1,el('bookmarkStart',id=bid,name=name));p.append(el('bookmarkEnd',id=bid));bid+=1
# Preserve the original cached page references until Word repaginates on update.
entries=[];current_page='4'
for p in ps[15:64]:
 if p.find('./'+q('pPr')+'/'+q('pStyle')) is None or p.find('./'+q('pPr')+'/'+q('pStyle')).get(q('val'))!='TocEntry':continue
 ts=p.xpath('.//w:t/text()',namespaces=ns);page=ts[-1] if len(ts)>1 and ts[-1].isdigit() else None
 old=''.join(ts[:-1] if page else ts)
 entries.append((p,old,page))
for i,(p,old,page) in enumerate(entries):
 if page is None:page=next((v[2] for v in entries[i+1:] if v[2]),current_page)
 current_page=page
 for x in list(p):p.remove(x)
 pp=child(p,'pPr');val(pp,'pStyle','TOC1' if re.match(r'^[IVXLCDM]+ ',old) or old.startswith('Annexe ') else 'TOC2')
 # Keep the existing two-page division as the initial field result.
 if old.startswith('18 '):val(pp,'pageBreakBefore',1)
 h=el('hyperlink',anchor=anchors[old],history=1);p.append(h)
 r=child(h,'r');font(child(r,'rPr'));child(r,'t').text=mapping.get(old,old)
 r=el('r');h.append(r);r.append(el('tab'));child(r,'t').text=page
# Remove old manual continuation title and page break; the TOC is a single Word field.
for p in [ps[36],ps[37]]:body.remove(p)
val(child(ps[14],'pPr'),'pStyle','SommaireTitre');font(child(ps[14][1],'rPr'))
first,last=entries[0][0],entries[-1][0]
def fieldrun(kind):
 r=el('r');r.append(el('fldChar',fldCharType=kind));return r
r=fieldrun('begin');r[0].set(q('dirty'),'true');first.insert(1,r)
r=el('r');it=el('instrText');it.set('{http://www.w3.org/XML/1998/namespace}space','preserve');it.text=' TOC \\o "1-2" \\h \\z \\u ';r.append(it);first.insert(2,r);first.insert(3,fieldrun('separate'));last.append(fieldrun('end'))
val(settings,'updateFields','true')
for path,root in [('word/document.xml',d),('word/styles.xml',styles),('word/numbering.xml',nums),('word/settings.xml',settings)]:data[path]=E.tostring(root,xml_declaration=True,encoding='UTF-8',standalone=True)
with ZipFile(out,'w',ZIP_DEFLATED) as z:
 for name,content in data.items():z.writestr(name,content)
assert chapter==9 and len(mapping)==43 and len(entries)==47
print('Created:',out.resolve())
print('Verified: 9 chapters, 34 numbered subsections, 4 appendices, 47 linked TOC entries, native TOC field, Calibri TOC styles.')
