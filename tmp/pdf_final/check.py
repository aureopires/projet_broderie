from pypdf import PdfReader
from pathlib import Path
import json,re
r=PdfReader('output/dossier_projet/Aureo_Ruffier_Dossier_Projet_DWWM.pdf')
texts=[p.extract_text() or '' for p in r.pages]
Path('tmp/pdf_final/text.txt').write_text('\n'.join(f'PAGE {i+1}\n{t}' for i,t in enumerate(texts)),encoding='utf8')
heads=json.loads(Path('tmp/pdf_final/headings.json').read_text(encoding='utf-8-sig'))
toc=Path('tmp/pdf_final/toc.txt').read_text(encoding='utf-8-sig')
errors=[];checked=0
for line in toc.splitlines():
 if '\t' not in line:continue
 title,num=line.rsplit('\t',1);title=title.strip();num=num.strip()
 match=[h for h in heads if h['text'].strip()==title]
 if not match or str(match[0]['page'])!=num:errors.append((title,num,match))
 else:
  checked+=1
  actual=re.sub(r'\s+',' ',texts[match[0]['physicalPage']-1])
  if re.sub(r'\s+',' ',title) not in actual:errors.append(('PDF text mismatch',title))
print('Pages',len(r.pages),'TOC entries checked',checked,'errors',errors)
print('Page lengths',[(i+1,len(t)) for i,t in enumerate(texts) if len(t)<180])
import pdfplumber
with pdfplumber.open('output/dossier_projet/Aureo_Ruffier_Dossier_Projet_DWWM.pdf') as pdf:
 issues=[]
 for i,p in enumerate(pdf.pages):
  for im in p.images:
   if im['x0']<0 or im['x1']>p.width+1 or im['top']<0 or im['bottom']>p.height+1:issues.append((i+1,im['x0'],im['x1'],im['top'],im['bottom']))
 print('Image page boundary violations',issues)
