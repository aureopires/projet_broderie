from pathlib import Path
from zipfile import ZipFile,ZIP_DEFLATED
from lxml import etree as E
from copy import deepcopy
src=Path('output/dossier_projet/Aureo_Ruffier_Dossier_Projet_DWWM.docx');out=src.with_name('Aureo_Ruffier_Dossier_Projet_DWWM_mise_en_page.docx')
w='http://schemas.openxmlformats.org/wordprocessingml/2006/main';ns={'w':w};q=lambda s:'{'+w+'}'+s
with ZipFile(src) as z:data={n:z.read(n) for n in z.namelist()}
d=E.fromstring(data['word/document.xml']);s=E.fromstring(data['word/styles.xml']);body=d.find(q('body'));ps=body.findall(q('p'))
def child(e,t):
 a=e.find(q(t))
 if a is None:a=E.SubElement(e,q(t))
 return a
def size(e,n):
 rp=child(e,'rPr')
 for t in ['sz','szCs']:child(rp,t).set(q('val'),str(n*2))
 if e.tag==q('r'):e.remove(rp);e.insert(0,rp)
def text(e):return ''.join(e.xpath('.//w:t/text()',namespaces=ns))
cover=[E.tostring(p) for p in ps[:13]]
# Isolate the cover so its geometry remains identical.
last=body.find(q('sectPr'));coversect=deepcopy(last)
sectiontype=coversect.find(q('type'))
if sectiontype is not None:sectiontype.set(q('val'),'nextPage')
sep=ps[13]
assert sep.xpath('.//w:br[@w:type="page"]',namespaces=ns)
for br in sep.xpath('.//w:br[@w:type="page"]',namespaces=ns):br.getparent().remove(br)
child(sep,'pPr').append(coversect)
margin=last.find(q('pgMar'))
for a in ['top','bottom','left','right']:margin.set(q(a),'1134')
# Preserve ongoing page numbering in the body section.
pgn=last.find(q('pgNumType'))
if pgn is not None:pgn.attrib.pop(q('start'),None)
# Separate body caption/source styles from any cover usage.
for old,new in [('Lgende','DossierCaption10'),('Source','DossierSource10')]:
 st=next(x for x in s.findall(q('style')) if x.get(q('styleId'))==old)
 clone=deepcopy(st);clone.set(q('styleId'),new);child(clone,'name').set(q('val'),new);size(clone,10);s.append(clone)
for st in s.findall(q('style')):
 name=st.get(q('styleId'),'')
 if name.startswith(('TM','TOC')):size(st,12)
started=False;count=0
for e in body:
 if e is ps[14]:started=True
 if not started:continue
 for p in ([e] if e.tag==q('p') else e.findall('.//'+q('p'))):
  pp=p.find(q('pPr'));st=pp.find(q('pStyle')) if pp is not None else None;sid=st.get(q('val')) if st is not None else 'Normal'
  if sid=='Lgende':st.set(q('val'),'DossierCaption10');target=10
  elif sid=='Source':st.set(q('val'),'DossierSource10');target=10
  elif sid=='Normal' or sid.startswith(('TM','TOC')):target=12
  else:continue
  # Code laid out inside comparison tables retains its monospace formatting.
  for r in p.iter(q('r')):
   fonts=r.xpath('./w:rPr/w:rFonts/@w:ascii',namespaces=ns)
   if fonts and fonts[0] in ['Consolas','Courier New']:continue
   size(r,target)
  count+=1
# Add an actual external hyperlink to the official RGAA reference.
relpath='word/_rels/document.xml.rels';rels=E.fromstring(data[relpath]);R='http://schemas.openxmlformats.org/package/2006/relationships'
rid='rId'+str(max(int(x.get('Id')[3:]) for x in rels if x.get('Id','').startswith('rId'))+1)
r=E.SubElement(rels,'{'+R+'}Relationship');r.set('Id',rid);r.set('Type','http://schemas.openxmlformats.org/officeDocument/2006/relationships/hyperlink');r.set('Target','https://accessibilite.numerique.gouv.fr/');r.set('TargetMode','External')
p=E.Element(q('p'));pp=E.SubElement(p,q('pPr'));E.SubElement(pp,q('pStyle')).set(q('val'),'Normal')
r=E.SubElement(p,q('r'));size(r,12);E.SubElement(r,q('t')).text='RGAA — Référentiel général d’amélioration de l’accessibilité (DINUM)';E.SubElement(r,q('br'))
h=E.SubElement(p,q('hyperlink'));h.set('{http://schemas.openxmlformats.org/officeDocument/2006/relationships}id',rid)
r=E.SubElement(h,q('r'));size(r,12);E.SubElement(r,q('t')).text='https://accessibilite.numerique.gouv.fr/'
anchor=next(x for x in body if x.tag==q('p') and text(x).startswith('CNIL Principes'))
anchor.addnext(p)
assert all(E.tostring(p)==v for p,v in zip(ps[:13],cover))
for path,root in [('word/document.xml',d),('word/styles.xml',s),(relpath,rels)]:data[path]=E.tostring(root,encoding='UTF-8',xml_declaration=True,standalone=True)
with ZipFile(out,'w',ZIP_DEFLATED) as z:
 for name,b in data.items():z.writestr(name,b)
from docx import Document
D=Document(out);assert len(D.sections)==2
assert len(D.inline_shapes)==len(Document(src).inline_shapes)
print(out.resolve());print('Paragraphs formatted:',count,'Images preserved:',len(D.inline_shapes))
print('Cover content unchanged. Cover margins unchanged. Body margins:',[round(D.sections[1].top_margin.cm,2),round(D.sections[1].left_margin.cm,2)])
