from zipfile import ZipFile, ZIP_DEFLATED
from lxml import etree as E
from pathlib import Path
p=Path('output/dossier_projet/Aureo_Ruffier_Dossier_Projet_DWWM_revise.docx')
out=p.with_name('Aureo_Ruffier_Dossier_Projet_DWWM_corrige.docx')
w='http://schemas.openxmlformats.org/wordprocessingml/2006/main';ns={'w':w}
def q(s):return '{'+w+'}'+s
def node(tag,value=None):
 e=E.Element(q(tag))
 if value is not None:e.set(q('val'),str(value))
 return e
with ZipFile(p) as z:data={n:z.read(n) for n in z.namelist()}
d=E.fromstring(data['word/document.xml']);s=E.fromstring(data['word/styles.xml']);n=E.fromstring(data['word/numbering.xml']);settings=E.fromstring(data['word/settings.xml'])
numid=s.xpath('//w:style[@w:styleId="Titre1"]/w:pPr/w:numPr/w:numId/@w:val',namespaces=ns)[0]
count=[0,0]
for p in d.xpath('//w:body/w:p',namespaces=ns):
 pp=p.find(q('pPr'))
 if pp is None:continue
 st=pp.find(q('pStyle'))
 if st is None:continue
 sid=st.get(q('val'))
 if sid not in ('Titre1','Titre2'):continue
 level=['Titre1','Titre2'].index(sid);count[level]+=1
 for old in pp.findall(q('numPr')):pp.remove(old)
 np=node('numPr');np.append(node('ilvl',level));np.append(node('numId',numid));pp.append(np)
# Explicitly disable the opening-time refresh prompt; manual TOC updates remain available.
for x in settings.findall(q('updateFields')):settings.remove(x)
for fc in d.iter(q('fldChar')):fc.attrib.pop(q('dirty'),None)
# Canonical WordprocessingML child order, crucial for Microsoft Word compatibility.
orders={
'pPr':'pStyle keepNext keepLines pageBreakBefore framePr widowControl numPr suppressLineNumbers pBdr shd tabs suppressAutoHyphens kinsoku wordWrap overflowPunct topLinePunct autoSpaceDE autoSpaceDN bidi adjustRightInd snapToGrid spacing ind contextualSpacing mirrorIndents suppressOverlap jc textDirection textAlignment textboxTightWrap outlineLvl divId cnfStyle rPr sectPr pPrChange',
'rPr':'rStyle rFonts b bCs i iCs caps smallCaps strike dstrike outline shadow emboss imprint noProof snapToGrid vanish webHidden color spacing w kern position sz szCs highlight u effect bdr shd fitText vertAlign rtl cs em lang eastAsianLayout specVanish oMath rPrChange',
'lvl':'start numFmt lvlRestart pStyle isLgl suff lvlText lvlPicBulletId legacy lvlJc pPr rPr',
'numPr':'ilvl numId numberingChange ins'}
repairs={}
for root in [d,s,n]:
 for tag,order in orders.items():
  indexes={name:i for i,name in enumerate(order.split())}
  for parent in root.iter(q(tag)):
   old=list(parent);new=sorted(old,key=lambda x:indexes.get(E.QName(x).localname,999))
   if old!=new:
    repairs[tag]=repairs.get(tag,0)+1
    parent[:]=new
# Ensure the numbering labels use standard list metadata.
a=n.xpath('//w:abstractNum[w:lvl/w:pStyle[@w:val="Titre1"]]',namespaces=ns)[0]
if a.find(q('nsid')) is None:a.insert(0,node('nsid','6A7B12D9'))
for path,root in [('word/document.xml',d),('word/styles.xml',s),('word/numbering.xml',n),('word/settings.xml',settings)]:data[path]=E.tostring(root,encoding='UTF-8',xml_declaration=True,standalone=True)
assert count==[9,34],count
assert len(d.xpath('//w:instrText[contains(text(),"TOC")]',namespaces=ns))==1
assert not settings.findall(q('updateFields'))
with ZipFile(out,'w',ZIP_DEFLATED) as z:
 for name,b in data.items():z.writestr(name,b)
print('Corrected paragraph numbering:',count,'OOXML order repairs:',repairs)
print(out.resolve())
