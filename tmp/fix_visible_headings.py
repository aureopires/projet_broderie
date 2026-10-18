from zipfile import ZipFile,ZIP_DEFLATED
from pathlib import Path
from lxml import etree as E
from copy import deepcopy
p=Path('output/dossier_projet/Aureo_Ruffier_Dossier_Projet_DWWM_corrige.docx')
out=p.with_name('Aureo_Ruffier_Dossier_Projet_DWWM_numerotation_visible.docx')
w='http://schemas.openxmlformats.org/wordprocessingml/2006/main';ns={'w':w};q=lambda s:'{'+w+'}'+s
with ZipFile(p) as z:data={n:z.read(n) for n in z.namelist()}
d=E.fromstring(data['word/document.xml']);styles=E.fromstring(data['word/styles.xml'])
chapter=sub=0;expected=[]
for para in d.xpath('//w:body/w:p[w:pPr/w:pStyle[@w:val="Titre1" or @w:val="Titre2"]]',namespaces=ns):
 pp=para.find(q('pPr'));sid=pp.find(q('pStyle')).get(q('val'))
 if sid=='Titre1':chapter+=1;sub=0;prefix=str(chapter)
 else:sub+=1;prefix=f'{chapter}.{sub}'
 np=pp.find(q('numPr'));np.clear();nid=E.SubElement(np,q('numId'));nid.set(q('val'),'0')
 # Insert visible prefix inside the existing heading bookmark, preserving runs.
 first=para.find(q('r'));r=E.Element(q('r'))
 if first is not None and first.find(q('rPr')) is not None:r.append(deepcopy(first.find(q('rPr'))))
 t=E.SubElement(r,q('t'));t.set('{http://www.w3.org/XML/1998/namespace}space','preserve');t.text=prefix+' '
 para.insert(para.index(first) if first is not None else 1,r)
 expected.append(''.join(para.xpath('.//w:t/text()',namespaces=ns)))
for st in styles.xpath('//w:style[@w:styleId="Titre1" or @w:styleId="Titre2"]',namespaces=ns):
 np=st.find('./'+q('pPr')+'/'+q('numPr'));np.clear();E.SubElement(np,q('numId')).set(q('val'),'0')
for name,root in [('word/document.xml',d),('word/styles.xml',styles)]:data[name]=E.tostring(root,encoding='UTF-8',xml_declaration=True,standalone=True)
assert chapter==9 and len(expected)==43
assert expected[1].startswith('1.1 ') and expected[2].startswith('1.2 ') and expected[3].startswith('1.3 ')
assert len(d.xpath('//w:instrText[contains(text(),"TOC")]',namespaces=ns))==1
with ZipFile(out,'w',ZIP_DEFLATED) as z:
 for n,b in data.items():z.writestr(n,b)
from docx import Document
check=Document(out)
visible=[p.text for p in check.paragraphs if p.style.style_id in ['Titre1','Titre2']]
assert visible==expected
print('Verified: all 43 headings contain visible numbering; native TOC preserved; no PDF created.')
print(out.resolve())
