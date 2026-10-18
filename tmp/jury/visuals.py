from pathlib import Path
import math
from PIL import Image, ImageDraw, ImageFont
import pypdfium2 as pdfium

root=Path.cwd();out=root/'tmp/jury/figures'
font='C:/Windows/Fonts/arial.ttf';bold='C:/Windows/Fonts/arialbd.ttf'
f=lambda size:ImageFont.truetype(font,size)
b=lambda size:ImageFont.truetype(bold,size)

im=Image.new('RGB',(1650,1180),'white');d=ImageDraw.Draw(im)
d.rectangle((280,35,1620,1140),outline='#333333',width=3)
d.text((950,65),'L’Aiguille des Volcans',font=b(34),fill='#222222',anchor='mm')
def actor(x,y,label):
 d.ellipse((x-20,y-70,x+20,y-30),outline='black',width=3)
 d.line((x,y-30,x,y+35),fill='black',width=3)
 d.line((x-35,y,x+35,y),fill='black',width=3)
 d.line((x,y+35,x-30,y+80),fill='black',width=3)
 d.line((x,y+35,x+30,y+80),fill='black',width=3)
 for i,line in enumerate(label.split('\n')):d.text((x,y+98+31*i),line,font=f(28),fill='black',anchor='mm')
def oval(x,y,label):
 d.ellipse((x-240,y-50,x+240,y+50),fill='#faf8f3',outline='#777777',width=2)
 lines=label.split('\n')
 for i,line in enumerate(lines):d.text((x,y+(i-(len(lines)-1)/2)*32),line,font=f(28),fill='black',anchor='mm')
def associate(y,positions):
 d.line((150,y,245,y),fill='#555555',width=2)
 ys=[p[1] for p in positions];d.line((245,min([y]+ys),245,max([y]+ys)),fill='#555555',width=2)
 for x,yy in positions:
  if x>1000:
   d.line((245,yy-65,x,yy-65,x,yy-50),fill='#555555',width=2)
   d.line((245,yy-65,245,yy),fill='#555555',width=2)
  else:d.line((245,yy,x-240,yy),fill='#555555',width=2)
def generalize(y1,y2):
 d.line((105,y1,105,y2+24),fill='black',width=3)
 d.polygon([(105,y2),(91,y2+24),(119,y2+24)],fill='white',outline='black',width=3)

public=[(610,160,'Consulter les prestations'),(1230,160,'Consulter le catalogue'),(610,300,'Lire les avis validés'),(1230,300,'Demander un devis'),(610,440,'Créer un compte'),(1230,440,'Se connecter')]
associate(260,[(x,y) for x,y,_ in public]);actor(105,260,'Visiteur')
associate(620,[(920,620)]);actor(105,620,'Utilisateur\nconnecté')
associate(960,[(610,810),(1230,810),(610,1040),(1230,1040)]);actor(105,960,'Administratrice')
generalize(545,435);generalize(885,805)
for x,y,label in public:oval(x,y,label)
oval(920,620,'Déposer un avis')
oval(610,810,'Gérer les produits\net les catégories')
oval(1230,810,'Consulter et suivre\nles demandes de devis')
oval(610,1040,'Modérer les avis')
oval(1230,1040,'Gérer les comptes')
im.save(out/'cas-utilisation.png')

im=Image.new('RGB',(1500,390),'white');d=ImageDraw.Draw(im)
colors=[('#FDFBF7','Fond ivoire'),('#B89753','Doré'),('#2C2522','Texte sombre'),('#EAE5DE','Bordures')]
for i,(color,label) in enumerate(colors):
 x=30+i*370;d.rounded_rectangle((x,35,x+335,255),12,fill=color,outline='#777777',width=2)
 d.text((x+167,295),label,font=b(28),fill='#222222',anchor='mm');d.text((x+167,337),color,font=f(25),fill='#222222',anchor='mm')
im.save(out/'palette.png')

pdf=pdfium.PdfDocument(str(root/'output/Exemplo/Corentin_Polard_Dossier_Projet.pdf'))
for page in [0,5,12,20]:pdf[page].render(scale=1.3).to_pil().save(out/f'reference-{page+1}.png')
print('Use case diagram, palette and reference samples prepared.')
