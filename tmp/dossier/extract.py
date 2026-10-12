from pathlib import Path
from pypdf import PdfReader
from zipfile import ZipFile
from lxml import etree
root=Path.cwd()
out=root/'tmp/dossier'
for p in (root/'output/Exemplo').glob('*.pdf'):
 r=PdfReader(p); t='\n'.join(f'\n--- PAGE {i+1} ---\n'+(x.extract_text() or '') for i,x in enumerate(r.pages)); (out/(p.stem+'.txt')).write_text(t,encoding='utf8'); print(p.name,len(r.pages))
p=root/'output/Aureo_Ruffier_Presentation_Projet.pptx'
with ZipFile(p) as z:
 names=sorted([n for n in z.namelist() if n.startswith('ppt/slides/slide') and n.endswith('.xml')],key=lambda n:int(n.split('slide')[-1].split('.')[0]))
 t='\n'.join(n+'\n'+'\n'.join(etree.fromstring(z.read(n)).xpath('//*[local-name()="t"]/text()')) for n in names)
 (out/'presentation.txt').write_text(t,encoding='utf8')
print(t)
