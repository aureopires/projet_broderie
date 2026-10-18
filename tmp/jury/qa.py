from pathlib import Path
from pypdf import PdfReader
import pypdfium2 as pdfium
from PIL import Image,ImageDraw
root=Path.cwd();p=root/'tmp/jury/verification.pdf';r=PdfReader(p);out=root/'tmp/jury/render';out.mkdir(exist_ok=True)
print('PAGES',len(r.pages))
report=[]
for i,page in enumerate(r.pages):
 t=page.extract_text() or '';lines=[x for x in t.splitlines() if x.strip()];record=f'{i+1}: {len(t)} chars | '+ ' | '.join(lines[:3])[:150];print(record);report.append(record)
(root/'tmp/jury/pagination.txt').write_text('\n'.join(report),encoding='utf8')
pdf=pdfium.PdfDocument(str(p))
for i in range(len(pdf)):pdf[i].render(scale=1.5).to_pil().save(out/f'page-{i+1}.png')
for start in range(0,len(pdf),4):
 canvas=Image.new('RGB',(1240,1630),'#cccccc');dr=ImageDraw.Draw(canvas)
 for j in range(start,min(start+4,len(pdf))):
  im=Image.open(out/f'page-{j+1}.png');im.thumbnail((605,780));x=(j-start)%2*620;y=(j-start)//2*815;canvas.paste(im,(x,y+25));dr.text((x+5,y+5),str(j+1),fill='black')
 canvas.save(out/f'contact-{start+1}.png')
