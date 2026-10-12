from pathlib import Path
from PIL import Image,ImageDraw,ImageFont
import zipfile,json,math

r=Path.cwd()/'output/design/nouveaux-svg';v=r/'verification'
names=['accueil','a-propos','prestations','galerie','demande-de-devis','contact','dashboard-admin']
labels=['Accueil','À propos','Prestations','Galerie','Demande de devis','Contact','Dashboard admin']
font=ImageFont.truetype('C:/Windows/Fonts/arialbd.ttf',20)
for name in names:
    im=Image.open(v/'05-maquettes-mobile'/(name+'.png')).convert('RGB');tiles=math.ceil(im.height/900)
    board=Image.new('RGB',(390*tiles,940),'#DEDAD3');draw=ImageDraw.Draw(board)
    for i in range(tiles):
        board.paste(im.crop((0,i*900,390,min((i+1)*900,im.height))),(i*390,40));draw.text((i*390+14,10),name+' / '+str(i+1),font=font,fill='#2C2522')
    board.save(v/('mobile-'+name+'.png'))

# Complete overviews for checking every wireframe.
for device,folder in [('desktop','02-wireframes-desktop'),('mobile','03-wireframes-mobile')]:
    ims=[]
    for name in names:
        im=Image.open(v/folder/(name+'.png')).convert('RGB');ww=230 if device=='desktop' else 170;im=im.resize((ww,round(im.height*ww/im.width)));ims.append(im)
    cell=250 if device=='desktop' else 190;board=Image.new('RGB',(cell*7,max(i.height for i in ims)+55),'#393939');draw=ImageDraw.Draw(board)
    for i,(im,label) in enumerate(zip(ims,labels)):board.paste(im,(i*cell+10,45));draw.text((i*cell+10,15),label,font=ImageFont.truetype('C:/Windows/Fonts/arial.ttf',14),fill='white')
    board.save(v/('wireframes-'+device+'.png'))

# A concise visual index shows the top of each actual reconstructed page.
board=Image.new('RGB',(1680,1140),'#EEEAE3');draw=ImageDraw.Draw(board)
draw.text((28,24),'L’Aiguille des Volcans — 7 páginas refeitas a partir dos prints',font=ImageFont.truetype('C:/Windows/Fonts/arialbd.ttf',28),fill='#2C2522')
for i,(name,label) in enumerate(zip(names,labels)):
    x=20+(i%4)*420;y=86+(i//4)*522;im=Image.open(v/'04-maquettes-desktop'/(name+'.png')).convert('RGB');im=im.crop((0,0,im.width,min(im.height,1650)));im.thumbnail((400,462));draw.text((x,y),label,font=font,fill='#2C2522');board.paste(im,(x,y+35))
board.save(r/'apercu.png')

target=r.parent/'svgs-aiguille-des-volcans-refaits.zip'
with zipfile.ZipFile(target,'w',zipfile.ZIP_DEFLATED) as z:
    for folder in ['01-brief','02-wireframes-desktop','03-wireframes-mobile','04-maquettes-desktop','05-maquettes-mobile','importador-editavel']:
        for p in (r/folder).rglob('*'):
            if p.is_file():z.write(p,p.relative_to(r))
    for name in ['index.html','LEIA-ME.md','apercu.png']:z.write(r/name,name)
with zipfile.ZipFile(target) as z:
    assert z.testzip() is None
    assert len([n for n in z.namelist() if n.endswith('.svg')])==29
report=json.loads((v/'controle.json').read_text(encoding='utf8'));report['rendered_svg_count']=29;report['zip_checked']=True
(v/'controle.json').write_text(json.dumps(report,ensure_ascii=False,indent=2),encoding='utf8')
print(target.name,round(target.stat().st_size/1000000,1),'MB; 29 SVGs completos.')
