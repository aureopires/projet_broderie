from pathlib import Path
from pypdf import PdfReader
import pypdfium2 as pdfium
from PIL import Image,ImageDraw
root=Path.cwd();p=root/'output/dossier_projet/Aureo_Ruffier_Dossier_Projet_DWWM.pdf';r=PdfReader(p);out=root/'tmp/dossier/render';out.mkdir(exist_ok=True)
print('PAGES',len(r.pages))
for i,page in enumerate(r.pages):
 t=page.extract_text() or '';lines=[x for x in t.splitlines() if x.strip()];print(i+1,len(t), ' | '.join(lines[:3])[:160])
pdf=pdfium.PdfDocument(str(p))
for i in range(len(pdf)):
 im=pdf[i].render(scale=1.5).to_pil();im.save(out/f'page-{i+1}.png')
for start in range(0,len(pdf),6):
 canvas=Image.new('RGB',(1230,1590),'#cccccc');dr=ImageDraw.Draw(canvas)
 for j in range(start,min(start+6,len(pdf))):
  im=Image.open(out/f'page-{j+1}.png');im.thumbnail((400,755));x=(j-start)%3*410;y=(j-start)//3*795;canvas.paste(im,(x,y+25));dr.text((x+5,y+5),str(j+1),fill='black')
 canvas.save(out/f'contact-{start+1}.png')
