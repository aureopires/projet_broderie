"""Reconstruction based on the seven supplied screenshots and Client documents.
No dependency on the previous maquettes or design brief.
"""
from pathlib import Path
from PIL import Image, ImageOps, ImageFont
from docx import Document
from pypdf import PdfReader
import re, json, html, base64, io, math, copy, zipfile
import xml.etree.ElementTree as ET

ROOT=Path.cwd(); SOURCE=ROOT/'output/design'; OUT=SOURCE/'nouveaux-svg'
WHITE='#FFFFFF'; BG='#FDFBF7'; INK='#2C2522'; GOLD='#B89753'; GRAY='#555555'; LIGHT='#F8F9FA'; BORDER='#DEE2E6'; BLUE='#0D6EFD'; YELLOW='#FFC107'
ASSETS={}; FONTS={}; SCREENS=[]
for folder in ['01-brief','02-wireframes-desktop','03-wireframes-mobile','04-maquettes-desktop','05-maquettes-mobile','importador-editavel','verification']:(OUT/folder).mkdir(exist_ok=True,parents=True)

def font(size,bold=False,serif=True,italic=False):
    key=(size,bold,serif,italic)
    if key not in FONTS:
        fn=('times'+('bi' if bold and italic else 'bd' if bold else 'i' if italic else '')+'.ttf') if serif else ('arial'+('bi' if bold and italic else 'bd' if bold else 'i' if italic else '')+'.ttf')
        FONTS[key]=ImageFont.truetype('C:/Windows/Fonts/'+fn,round(size))
    return FONTS[key]

class Page:
    def __init__(self,id,title,mobile=False,background=BG):
        self.id=id;self.title=title;self.mobile=mobile;self.w=390 if mobile else 1115;self.h=100;self.nodes=[];self.section='Fond';self.background=background
    def group(self,name):self.section=name
    def add(self,n):n['group']=self.section;self.nodes.append(n);return n
    def rect(self,x,y,w,h,fill=WHITE,stroke=None,r=0,name='Surface',shadow=False):
        return self.add(dict(type='rect',x=x,y=y,w=w,h=h,fill=fill,stroke=stroke,r=r,name=name,shadow=shadow))
    def line(self,x,y,w,color=BORDER):self.rect(x,y,w,1,color,name='Séparateur')
    def text(self,x,y,t,size=16,w=None,bold=False,serif=True,color=INK,align='left',lh=None,italic=False,spacing=0,name=None):
        w=w or self.w-x-24;lh=lh or size*1.45;f=font(size,bold,serif,italic);lines=[]
        for para in t.split('\n'):
            line=''
            for word in para.split():
                trial=(line+' '+word).strip()
                if f.getlength(trial)+max(0,len(trial)-1)*spacing>w and line:lines.append(line);line=word
                else:line=trial
            lines.append(line)
        n=dict(type='text',x=x,y=y,w=w,h=len(lines)*lh,text='\n'.join(lines),lines=lines,size=size,bold=bold,serif=serif,italic=italic,color=color,align=align,lineHeight=lh,spacing=spacing,name=name or t[:70])
        self.add(n);return n['h']
    def image(self,x,y,w,h,path,fit='contain',r=0,name=None):
        path=ROOT/path;im=ImageOps.exif_transpose(Image.open(path));key=path.as_posix()+'|'+fit+'|'+str(round(w))+'x'+str(round(h))
        if key not in ASSETS:
            if fit=='cover':im=ImageOps.fit(im,(max(1,round(w*1.5)),max(1,round(h*1.5))),method=Image.Resampling.LANCZOS)
            else:im.thumbnail((max(1,round(w*1.5)),max(1,round(h*1.5))))
            b=io.BytesIO();transparent=im.mode in ('RGBA','LA') or 'transparency' in im.info
            if transparent:im.save(b,format='PNG');mime='image/png'
            else:im.convert('RGB').save(b,format='JPEG',quality=90);mime='image/jpeg'
            ASSETS[key]=dict(data=base64.b64encode(b.getvalue()).decode(),mime=mime)
        return self.add(dict(type='image',x=x,y=y,w=w,h=h,key=key,fit=fit,r=r,name=name or path.name))
    def icon(self,x,y,w,h,key,color=INK,style='solid'):
        p=ROOT/'node_modules/@fortawesome/fontawesome-free/svgs'/style/(key+'.svg');e=ET.parse(p).getroot()
        return self.add(dict(type='icon',x=x,y=y,w=w,h=h,viewBox=e.get('viewBox'),paths=[a.get('d') for a in e.iter() if a.tag.endswith('path')],fill=color,name=key))
    def button(self,x,y,w,h,label,fill=GOLD,color=WHITE,stroke=None,r=4,size=13,serif=True,bold=False):
        self.rect(x,y,w,h,fill,stroke,r,name='Bouton / '+label)
        while font(size,bold,serif).getlength(label)>w-16 and size>9:size-=.5
        th=self.text(x+8,y+(h-size*1.35)/2,label,size,w-16,bold,serif,color,'center',lh=size*1.35)
        return y+h
    def paragraph(self,x,y,w,t,size=16,color=INK,gap=14):return y+self.text(x,y,t,size,w,color=color)+gap
    def finish(self,h):self.h=math.ceil(h);return self

NAV=[('Accueil','accueil'),('À propos','a-propos'),('Prestations','prestations'),('Galerie','galerie'),('Demande de devis','demande-de-devis'),('Contact','contact')]
ADMINNAV=[('Dashboard','dashboard-admin'),('Devis','devis'),('Avis','avis'),('Produits','produits'),('Catégories','categories'),('Utilisateurs','utilisateurs')]

def header(p,admin=False):
    p.group('Header / Navigation');p.rect(0,0,p.w,78,WHITE,shadow=True)
    p.image(54 if not p.mobile else 20,4,215 if not p.mobile else 172,68,'assets/images/logo_nav.png',name='Logo L’Aiguille des Volcans')
    if p.mobile:
        p.rect(284,22,34,34,WHITE,BORDER,4);p.icon(294,30,14,18,'moon');p.rect(332,22,38,34,WHITE,BORDER,4);p.icon(341,32,20,15,'bars');return
    nav=ADMINNAV if admin else NAV
    positions=[474,572,623,674,754,851] if admin else [338,407,490,593,663,806]
    widths=[94,48,45,76,99,104] if admin else [67,82,103,70,143,73]
    for (label,id),x,w in zip(nav,positions,widths):
        color=GOLD if id==p.id else INK
        p.text(x,31,label.upper(),12,w,bold=True,serif=False,color=color,spacing=.25,lh=17)
        if id==p.id:p.rect(x-2,54,w-4,1,GOLD)
    x=962 if admin else 888;p.rect(x,23,41,34,WHITE,'#EAE5DE',4);p.icon(x+13,31,14,18,'moon')
    if admin:p.rect(1018,23,42,34,WHITE,INK,4);p.icon(1032,34,14,13,'right-from-bracket')
    else:p.button(944,24,116,29,'SE CONNECTER',size=11,serif=False,bold=True)

FEATURES=[('heart','Fait avec passion','Un savoir-faire artisanal et des finitions soignées.'),('award','Qualité & Durabilité','Matériaux sélectionnés pour durer dans le temps.'),('handshake-simple','Écoute & Conseil','Accompagnement personnalisé à chaque étape.'),('location-dot','Atelier Local','Basé à Clermont-Ferrand (63), au cœur de l’Auvergne.')]
def featurebar(p,y):
    p.group('Footer / Engagements');h=310 if p.mobile else 107;p.rect(0,y,p.w,h,WHITE);p.line(0,y,p.w,'#EAE5DE');p.line(0,y+h-1,p.w,'#EAE5DE')
    for i,(icon,title,desc) in enumerate(FEATURES):
        x=24 if p.mobile else 55+i*257;yy=y+25+i*69 if p.mobile else y+25;ww=300 if p.mobile else 197
        p.icon(x,yy+7,29,30,icon,YELLOW);p.text(x+44,yy,title,15,ww,bold=True,lh=20)
        p.text(x+44,yy+22,desc,14,ww,color=INK,lh=20)
    return y+h

# Client paragraphs are preserved; only typographic spelling/spacing corrections.
doc=Document(SOURCE/'Client/maquettage site oce.docx')
CLIENT_PARAGRAPHS=[p.text.strip() for p in doc.paragraphs if p.text.strip()]
pdf=PdfReader(SOURCE/'Client/site .pdf');PDF_TEXT=[p.extract_text() for p in pdf.pages]
(OUT/'verification/sources-client.txt').write_text('\n\n'.join(CLIENT_PARAGRAPHS)+'\n\nPDF\n'+'\n\n'.join(PDF_TEXT),encoding='utf8')

def template_paragraphs(path,begin,end):
    # Restore text obscured by Symfony's toolbar using the matching current template.
    s=(ROOT/path).read_text(encoding='utf8');s=s[s.index(begin):s.index(end)]
    return [re.sub(r'\s+',' ',html.unescape(re.sub('<[^>]+>','',x))).strip() for x in re.findall(r'<p(?:\s[^>]*)?>(.*?)</p>',s,re.S)]
WELCOME=template_paragraphs('templates/front/home/index.html.twig','Bienvenue dans mon atelier','Réalisations récentes')[0]
HISTORY=template_paragraphs('templates/front/home/about.html.twig','<h2 class="mb-4">Mon histoire','<!-- Section Mon Savoir')
KNOWHOW=template_paragraphs('templates/front/home/about.html.twig','<h2 class="mb-4">Mon savoir-faire','<!-- Section Mes Valeurs')
VALUES=[('Passion et transmission :','La couture et la broderie sont bien plus qu’un métier : elles sont une passion familiale transmise depuis plusieurs générations. À travers mon atelier, je souhaite faire vivre cet héritage en créant des pièces uniques réalisées avec le même amour du travail bien fait.'),('Qualité et exigence :','Je porte une attention particulière à chaque étape de la réalisation, du choix des textiles aux finitions. Mon objectif est de proposer des créations soignées durables et à la hauteur des attentes de mes clients. C’est pourquoi je me tourne vers des fournisseurs français et européens principalement et reconnus pour la qualité de leurs produits.'),('Écoute et proximité :','Chaque projet est unique. Je prends le temps d’échanger avec chacun de mes clients, afin de comprendre leurs besoins, de les conseiller et de les accompagner dans leur choix. Cette relation de confiance est essentielle pour créer des réalisations qui leur ressemblent.')]
AUDIENCES=[('Pour les particuliers','Faites plaisir ou faites-vous plaisir ! Rendez vos moments en souvenirs inoubliables grâce à des textiles personnalisés.'),('Vous êtes professionnels ?','Je vous aide à transformer votre image d’entreprise grâce à la broderie, la sublimation ou bien le flocage.'),('Les associations','Développez l’esprit d’équipe et l’identité de votre association avec des personnalisations de qualité.')]
REVIEWS=[('Thomas','Coffret Naissance Brodé','Un cadeau de naissance très apprécié par les parents. Les broderies sont douces et impeccables.'),('Lucas','Sac Cabas Personnalisé en Toile','Superbe qualité de broderie. Le sac est solide et le rendu des initiales est très élégant. Je recommande vivement !'),('Marie','Cadre Brodé Main - Bouquet Floral','Absolument magnifique ! Le cadre est accroché dans mon salon et tout le monde me fait des compliments sur les finitions.')]

def stars(p,x,y,rating=5,size=15):
    for i in range(5):p.icon(x+i*(size+4),y,size,size,'star',YELLOW,'solid' if i<rating else 'regular')

def accueil(mobile):
    p=Page('accueil','Accueil',mobile);header(p);p.group('Hero / L’art du fil')
    if mobile:
        p.image(0,78,390,230,'assets/images/hero.png','cover',name='Hero broderie')
        p.rect(0,308,390,322,BG);p.text(20,335,'ATELIER DE BRODERIE, PERSONNALISATION TEXTILE & COUTURE',11,350,color=GOLD,spacing=1,lh=18)
        p.text(20,391,'L’art du fil,',34,350,bold=True,lh=42);p.text(20,438,'la beauté du\nsur-mesure',32,350,color=GOLD,italic=True,lh=40)
        p.text(20,527,'Des créations uniques brodées avec passion pour les particuliers, professionnels, associations et collectivités.',15,350,color=GRAY,lh=22)
        p.button(20,599,262,31,'DÉCOUVRIR NOS PRESTATIONS  →',size=12,bold=True);y=670;x=20;w=350
    else:
        p.image(0,78,1115,440,'assets/images/hero.png','cover',name='Hero broderie')
        p.text(55,169,'ATELIER DE BRODERIE, PERSONNALISATION TEXTILE &\nCOUTURE',13,505,color=GOLD,spacing=1.3,lh=21)
        p.text(55,214,'L’art du fil,',44,530,bold=True,lh=54);p.text(55,266,'la beauté du sur-mesure',43,550,color=GOLD,italic=True,lh=53)
        p.text(55,338,'Des créations uniques brodées avec passion pour les particuliers, professionnels, associations et collectivités.',16,475,color=GRAY,lh=23)
        p.button(55,400,258,29,'DÉCOUVRIR NOS PRESTATIONS  →',size=12,bold=True);y=575;x=140;w=835
    p.group('Présentation de l’atelier');start=630 if mobile else 518
    titleh=p.text(x,y,'Bienvenue dans mon atelier de broderie',26 if mobile else 30,w,bold=True);y+=titleh+22
    y=p.paragraph(x,y,w,WELCOME,16,GRAY,42)
    p.group('Réalisations récentes');y+=15;y+=p.text(x,y,'Réalisations récentes :',27,w,bold=True,align='center')+28
    if mobile:
        for i in range(3):
            p.rect(20,y,350,278,LIGHT,r=6,shadow=True);p.image(28,y+8,334,262,f'assets/images/recent{i+1}.jpg',r=5);y+=300
    else:
        for i in range(3):
            xx=140+i*284;p.rect(xx,y,264,252,LIGHT,r=6,shadow=True);p.image(xx+8,y+8,248,236,f'assets/images/recent{i+1}.jpg',r=5)
        y+=300
    p.group('Pour qui ?');y+=18;y+=p.text(20 if mobile else 55,y,'Pour qui ?',27,p.w-40 if mobile else 1005,bold=True,align='center')+38
    if mobile:
        for title,desc in AUDIENCES:
            p.rect(20,y,350,148,LIGHT,BORDER,6);p.text(38,y+21,title,20,314,bold=True,align='center');p.text(40,y+57,desc,14,310,color=GRAY,align='center',lh=21);y+=166
    else:
        for i,(title,desc) in enumerate(AUDIENCES):
            xx=55+i*342;p.rect(xx,y,320,150,LIGHT,BORDER,6);p.text(xx+20,y+23,title,20,280,bold=True,align='center');p.text(xx+22,y+61,desc,14,276,color=GRAY,align='center',lh=20)
        y+=150
    y+=44;p.group('Témoignages');begin=y
    backdrop=p.rect(0,y,p.w,500,LIGHT);y+=46
    p.text(20,y,'TÉMOIGNAGES',12,p.w-40,color=GOLD,align='center',spacing=1.5);y+=24;y+=p.text(20,y,'Ce que nos clients disent',29,p.w-40,bold=True,align='center')+40
    if mobile:
        for author,product,review in REVIEWS:
            p.rect(20,y,350,225,WHITE,r=4,shadow=True);stars(p,46,y+28);p.text(46,y+66,'“'+review+'”',14,298,color=GRAY,lh=21);p.line(46,y+165,298);p.text(46,y+181,product+' - '+author,14,298,bold=True,lh=20);y+=245
    else:
        for i,(author,product,review) in enumerate(REVIEWS):
            xx=55+i*342;p.rect(xx,y,320,225,WHITE,r=4,shadow=True);stars(p,xx+28,y+28);p.text(xx+28,y+66,'“'+review+'”',14,264,color=GRAY,lh=20);p.line(xx+28,y+159,264);p.text(xx+28,y+177,product+' - '+author,14,264,bold=True,lh=20)
        y+=225
    y+=22;p.text(20 if mobile else 800,y,'Voir tous les avis  →',16,350 if mobile else 260,bold=True,align='right');y+=58;backdrop['h']=y-begin
    # In the screenshot the introduction section has a white background.
    p.nodes.insert(1,dict(type='rect',x=0,y=start,w=p.w,h=begin-start,fill=WHITE,stroke=None,r=0,name='Fond présentation',shadow=False,group='Fond'))
    return p.finish(featurebar(p,y+55)+35)

def about(mobile):
    p=Page('a-propos','À propos',mobile);header(p);p.group('Titre de page');p.text(20,88,'À propos',35 if mobile else 44,p.w-40,bold=True,align='center');y=156 if mobile else 145
    p.group('Mon histoire');bg=p.rect(0,y,p.w,100,WHITE);y+=45;x=20 if mobile else 140;w=350 if mobile else 548
    y+=p.text(x,y,'Mon histoire',29 if mobile else 32,w)+24;start=y
    if mobile:
        p.image(67,y,256,384,'assets/images/oce.jpg',r=4,name='Portrait Océane');y+=414
        for t in HISTORY:y=p.paragraph(20,y,350,t,16,gap=17)
    else:
        for t in HISTORY:y=p.paragraph(x,y,w,t,16,gap=17)
        p.image(711,start+12,264,397,'assets/images/oce.jpg',r=4,name='Portrait Océane')
        y=max(y,start+430)
    y+=30;bg['h']=y-bg['y'];p.group('Mon savoir-faire');y+=48
    if mobile:
        y+=p.text(20,y,'Mon savoir-faire',29,350)+24;p.image(20,y,350,263,'assets/images/savoir.png',r=4);y+=291
        for t in KNOWHOW:y=p.paragraph(20,y,350,t,16,gap=17)
    else:
        start=y;y+=p.text(424,y,'Mon savoir-faire',32,551)+24
        for t in KNOWHOW:y=p.paragraph(424,y,551,t,16,gap=17)
        p.image(140,start+86,264,197,'assets/images/savoir.png',r=4)
    y+=38;p.group('Mes valeurs');bg=p.rect(0,y,p.w,100,WHITE);y+=44
    x=20 if mobile else 140;cw=350 if mobile else 835;y+=p.text(x,y,'Mes valeurs',30,cw)+14
    y+=p.text(x,y,'Chez l’aiguille des volcans chaque projet est guidé par des valeurs qui me tiennent à cœur et qui sont au centre de mon travail au quotidien.',18,cw,color=GRAY,lh=25)+24
    if mobile:
        for title,desc in VALUES:
            st=len(p.nodes);p.rect(20,y,350,100,WHITE,BORDER,4,shadow=True);yy=y+23;yy+=p.text(42,yy,title,20,306,bold=True,lh=25)+12;yy+=p.text(42,yy,desc,15,306,color=GRAY,lh=23)+24;p.nodes[st]['h']=yy-y;y=yy+20
    else:
        for i,(title,desc) in enumerate(VALUES):
            xx=140+i*284;p.rect(xx,y,264,253,WHITE,BORDER,4,shadow=True);hh=p.text(xx+22,y+22,title,20,220,bold=True,lh=24);p.text(xx+22,y+hh+30,desc,14,220,color=GRAY,lh=19.5)
        y+=253
    y+=42;bg['h']=y-bg['y'];p.group('L’atelier');y+=48;y+=p.text(20 if mobile else 140,y,'L’atelier',32,350 if mobile else 835)+24
    items=[('atelier_machine.jpg',"L’atelier est équipé d’une machine à broder 15 couleurs de chez maison broderie.",448),('wilcom_logiciel.jpg',"Envoyez-moi une photo de votre logo et grâce au logiciel Wilcom je le transforme en un fichier prêt à broder.",178),('broderie_support.jpg','Je peux broder sur différents supports.',448)]
    for i,(im,t,h) in enumerate(items):
        p.group('L’atelier / '+im)
        if mobile:
            ww=350;hh=h*350/336;p.image(20,y,ww,hh,'assets/images/'+im,r=4);y+=hh+24;y+=p.text(20,y,t,18,350,lh=27)+38
        else:
            left=i%2==0;p.image(140 if left else 639,y,336,h,'assets/images/'+im,r=4);p.text(498 if left else 140,y+h/2-28,t,20,477,lh=28);y+=h+44
    return p.finish(featurebar(p,y+55)+30)

CATEGORIES=[('Broderie personnalisée','Personnaliser vos vêtements accessoires et cadeaux grâce à une broderie de qualité durable et élégante. Logo, prénoms, motifs ou texte : chaque création est réalisée avec soin.','1-6a980cb0ae5f4.jpg'),('Personnalisation textile et accessoires','Je personnalise vos vêtements professionnels, vos tenues d’association, équipements sportifs ou textiles publicitaires afin de valoriser votre image.','2-6a980ce9f27d5.jpg'),('Couture et retouches','Besoin d’une retouche ? Je réalise différents travaux de couture avec précision pour donner une seconde vie à vos textiles ou créer une pièce unique.','3-6a980cf9a9634.jpg'),('Création sur mesure','Envie d’un cadeau personnalisé ou d’une création unique ? Ensemble nous imaginons un projet qui vous ressemble, adapté à vos envies et à votre budget.','4-6a980d0850786.jpg')]
PRODUCTS=[('Veste en Jean Personnalisée','Customisation de votre veste en jean avec un motif floral ou lettrage au dos brodé su…','90 €','Veste-en-Jean-Personnalisee-6ac107cf3a244.jpg'),('Tablier de Cuisine Brodé - Prénom','Tablier de cuisine robuste en mélange coton-lin, personnalisable avec un texte brodé …','28 €','Tablier-de-Cuisine-Brode-Prenom-6ac107ba83189.jpg'),('Coffret Naissance Brodé','Ensemble personnalisé pour bébé comprenant un doudou, un bavoir et une sortie de bain…','65 €','Coffret-Naissance-Brode-6ac107a9e9261.jpg'),('Retouche et Ourlet de Pantalon','Service de retouche professionnel pour vos pantalons et jeans. Ajustement parfait d…','15 €','Retouche-et-Ourlet-de-Pantalon-6ac1079ca57ad.jpg'),('Sac Cabas Personnalisé en Toile','Grand sac cabas résistant en coton biologique, personnalisé avec la broderie de votre…','32 €','Sac-Cabas-Personnalise-en-Toile-6ac10785eb30b.jpg'),('Cadre Brodé Main - Bouquet Floral','Magnifique cadre décoratif brodé à main levée représentant un délicat bouquet de fleu…','27 €','Cadre-Brode-Main-Bouquet-Floral-6ac10777eb4de.jpg')]

def prestations(mobile):
    p=Page('prestations','Prestations',mobile);header(p);p.group('Titre de page');y=126
    p.text(20,y,'NOTRE SAVOIR-FAIRE',14,p.w-40,bold=True,color='#6C757D',align='center');y+=29
    y+=p.text(20 if mobile else 100,y,'Des services sur-mesure pour tous vos projets',32 if mobile else 48,350 if mobile else 915,bold=True,align='center',lh=38 if mobile else 54)+14
    y+=p.text(20,y,'Découvrez nos différentes catégories de créations et broderies.',16,p.w-40,color=INK,align='center')+44
    for i,(title,desc,key) in enumerate(CATEGORIES):
        p.group('Prestation / '+title);xx=20 if mobile else 55+i*257;ww=350 if mobile else 235;hh=435 if mobile else 364;iy=y if mobile else y
        p.rect(xx,iy,ww,hh,WHITE,r=16,shadow=True);p.image(xx,iy,ww,210 if mobile else 162,'public/uploads/categories/'+key,'cover',r=12)
        th=p.text(xx+16,iy+(226 if mobile else 178),title,23 if mobile else 21,ww-32,bold=True,lh=25)
        short=desc if mobile else desc[:70]+'…';p.text(xx+16,iy+(226 if mobile else 178)+th+6,short,15,ww-32,lh=21)
        p.line(xx+16,iy+hh-50,ww-32);p.button(xx+ww-70,iy+hh-41,54,28,'Voir',WHITE,BLUE,BLUE,16,14)
        if mobile:y+=hh+24
    if not mobile:y+=364
    y+=44;p.button((p.w-188)/2,y,188,35,'Voir tous les produits',BG,INK,INK,20,15);y+=35
    return p.finish(featurebar(p,y+55)+30)

def galerie(mobile):
    p=Page('galerie','Galerie',mobile);header(p);p.group('Titre de page');y=124
    y+=p.text(20,y,'Nos Créations Brodées',34 if mobile else 48,p.w-40,bold=True,align='center',lh=42 if mobile else 58)+11
    y+=p.text(20,y,'Découvrez notre collection exclusive de pièces uniques brodées avec amour.',16,p.w-40,align='center')+42
    p.group('Filtres de catégories');y+=p.text(20,y,'CATÉGORIES',14,p.w-40,bold=True,color='#6C757D',align='center')+20
    widths=[158,240,145,143];labels=[c[0] for c in CATEGORIES]
    if mobile:
        for i,label in enumerate(labels):p.button(20,y,350,35,label,BG,INK,INK,19,14);y+=44
        y+=24
    else:
        xx=202
        for label,ww in zip(labels,widths):p.button(xx,y,ww,35,label,BG,INK,INK,19,14);xx+=ww+8
        y+=79
    for i,(title,desc,price,key) in enumerate(PRODUCTS):
        p.group('Création / '+title);xx=20 if mobile else 55+(i%3)*342;yy=y if mobile else y+(i//3)*420;ww=350 if mobile else 320;hh=397
        p.rect(xx,yy,ww,hh,WHITE,r=16,shadow=True);p.image(xx,yy,ww,216,'public/uploads/products/'+key,'cover',r=12)
        th=p.text(xx+16,yy+231,title,21,ww-32,bold=True,lh=24);p.text(xx+16,yy+th+239,desc,14,ww-32,lh=20)
        p.line(xx+16,yy+hh-51,ww-32);p.text(xx+16,yy+hh-36,price,20,100,bold=True,color=BLUE);p.button(xx+ww-70,yy+hh-44,54,28,'Voir',WHITE,BLUE,BLUE,16,14)
        if mobile:y+=hh+24
    if not mobile:y+=817
    return p.finish(featurebar(p,y+55)+30)

FIELDS=[('Type d’article souhaité','Casquette, écusson…','text'),('Origine de l’article','Choisissez une option','select'),('Type de marquage','Choisissez une option','select'),('Logo (optionnel)','Aucun fichier choisi','upload'),('Quantité à personnaliser','Saisissez la quantité','text'),('Prénom','','text'),('Nom','','text'),('Type d’organisme','Choisissez une option','select'),('Nom de l’organisme','Ajouter réponse ici','text'),('Votre Email','','text'),('Téléphone','Téléphone','text'),('Décrivez-nous votre projet','Ajouter réponse ici','textarea')]
def devis(mobile):
    p=Page('demande-de-devis','Demande de devis',mobile);header(p);p.group('Titre de page');y=124
    x=20 if mobile else 185;y+=p.text(x,y,'Demander un devis',31 if mobile else 38,350 if mobile else 744,lh=46)+19
    for label,val,kind in FIELDS:
        p.group('Formulaire / '+label);h=123 if kind=='textarea' else 38
        if mobile:
            labh=p.text(20,y,label,16,350);fy=y+labh+8;xx=20;ww=350
        else:
            p.text(185,y+8,label,16,110,lh=22);fy=y;xx=313;ww=616
        p.rect(xx,fy,ww,h,WHITE,'#777777')
        if kind=='upload':
            p.rect(xx,fy,145,h,LIGHT,'#777777');p.text(xx+10,fy+10,'Choisir un fichier',14,130);p.text(xx+155,fy+10,val,14,ww-165);p.text(xx,fy+h+5,'Fichiers images uniquement (max. 15 Mo)',13,ww,color=GRAY);extra=23
        else:
            p.text(xx+12,fy+9,val,15,ww-40,color=GRAY)
            if kind=='select':p.icon(xx+ww-25,fy+15,10,8,'chevron-down')
            extra=0
        y=fy+h+extra+(20 if mobile else 32 if kind in ('select','upload') or label in ('Type d’article souhaité','Quantité à personnaliser','Type d’organisme','Nom de l’organisme') else 14)
    y+=20;p.button(20 if mobile else 643,y,350 if mobile else 308,30,'ENVOYER',size=13,bold=True);y+=30
    return p.finish(featurebar(p,y+110 if not mobile else y+60)+30)

def contact(mobile):
    p=Page('contact','Contact',mobile);header(p);p.group('Titre de page');p.text(20,106,'Contact',40 if mobile else 44,p.w-40,bold=True,align='center');y=172
    p.group('Coordonnées');back=p.rect(0,y,p.w,100,WHITE);y+=64
    x=20 if mobile else 140;ww=350 if mobile else 398
    coord="Je suis joignable par téléphone au 0677895869.\nVous pouvez aussi bien sûr venir à l’Atelier qui se situe au 4 Route de Clermont 63530 Volvic (Il est préférable de téléphoner avant).\nRetrouvez-moi également sur Facebook et Instagram."
    th=p.text(x,y,coord,16,ww,color=GRAY,lh=26);p.image(x+20,y+th+26,ww-40,120,'assets/images/logo_nav.png')
    sy=y+th+173;p.icon(x+ww/2-35,sy,25,25,'facebook','#1877F2','brands');p.icon(x+ww/2+12,sy,25,25,'instagram','#FF2E65','brands')
    cy=sy+58;notice=p.rect(x,cy,ww,100,LIGHT,r=5,shadow=True);nh=p.text(x+12,cy+18,'L’Aiguille des Volcans n’est pas un magasin.',17,ww-24,bold=True,align='center',lh=23);dh=p.text(x+12,cy+nh+29,'L’atelier est ouvert seulement sur rendez-vous.',15,ww-24,align='center');notice['h']=nh+dh+47
    if mobile:fy=cy+notice['h']+38;fx=20;fw=350
    else:fy=y;fx=577;fw=398
    p.group('Formulaire de contact');form=p.rect(fx,fy,fw,100,LIGHT,r=6,shadow=True);yy=fy+25
    if mobile:
        for label in ['Prénom','Nom']:
            p.text(fx+24,yy,label,16,fw-48,bold=True);p.rect(fx+24,yy+29,fw-48,34,WHITE,BORDER,4);yy+=78
    else:
        for i,label in enumerate(['Prénom','Nom']):
            xx=fx+24+i*183;p.text(xx,yy,label,16,168,bold=True);p.rect(xx,yy+29,168,34,WHITE,BORDER,4)
        yy+=78
    for label,h in [('Entité',34),('Adresse mail',34),('Votre message :',120)]:
        p.text(fx+24,yy,label,16,fw-48,bold=True);p.rect(fx+24,yy+29,fw-48,h,WHITE,BORDER,4);yy+=29+h+16
    p.button(fx+fw-133,yy,110,30,'ENVOYER',size=13,bold=True);yy+=54;form['h']=yy-fy
    y=max(yy,cy+86)+42;p.group('Plan d’accès');p.line(20 if mobile else 130,y,350 if mobile else 855);y+=23
    y+=p.text(20,y,'Retrouvez l’atelier sur la carte',23,p.w-40,bold=True,align='center')+18
    # User selected the map supplied in the client document.
    p.rect(20 if mobile else 140,y,350 if mobile else 835,260 if mobile else 470,WHITE,r=5,shadow=True,name='Carte / plan d’accès')
    p.image(20 if mobile else 140,y,350 if mobile else 835,260 if mobile else 470,'assets/images/localisation.jpg','cover',r=5,name='Carte fournie par le client')
    y+=260 if mobile else 470;y+=44;back['h']=y-back['y']
    return p.finish(featurebar(p,y+54)+30)

QUOTES=[('aureo pires','Casquete','Finished','09/09/2026','#198754'),('Antoine Leroy','Veste professionnelle','New','06/09/2026',YELLOW),('Client','Tee-shirt','Processing','04/09/2026','#0DCAF0'),('Julien Bernard','Sac en toile','New','02/09/2026',YELLOW),('Camille Moreau','Tablier de cuisine','New','01/09/2026',YELLOW)]
ADMINREVIEWS=[('Nicolas',4,'En attente',YELLOW,'Le tablier est de très bonne facture, le tissu ne se froisse pas trop et la broderie tient…'),('Thomas',5,'Approuvé','#198754','Un cadeau de naissance très apprécié par les parents. Les broderies sont douces et impeccables…'),('Sophie',4,'Rejeté','#DC3545','Service rapide et soigné pour mon ourlet. On ne voit même pas que le pantalon a été retouché…'),('Lucas',5,'Approuvé','#198754','Superbe qualité de broderie. Le sac est solide et le rendu des initiales est très élégant…'),('Marie',5,'Approuvé','#198754','Absolument magnifique ! Le cadre est accroché dans mon salon et tout le monde me fait des…')]
def dashboard(mobile):
    p=Page('dashboard-admin','Dashboard admin',mobile);header(p,True);p.group('Titre de page');y=128
    p.text(20 if mobile else 55,y,'Administration',16,350 if mobile else 700,color=GRAY);y+=24
    y+=p.text(20 if mobile else 55,y,'Tableau de bord',34 if mobile else 40,350 if mobile else 700,bold=True,lh=48)+20
    if mobile:p.button(20,y,134,35,'← Voir le site',BG,INK,INK,4,15);y+=59
    else:p.button(943,143,117,35,'← Voir le site',BG,INK,INK,4,15)
    p.group('Indicateurs');labels=['Demandes de devis','Nouveaux devis','Avis','Produits','Catégories','Utilisateurs'];counts=['5','3','5','6','4','56'];icons=['file-signature','clock','star','shirt','layer-group','users']
    for i,(label,count,icon) in enumerate(zip(labels,counts,icons)):
        xx=20+(i%2)*182 if mobile else 55+i*171;yy=y+(i//2)*137 if mobile else y;ww=168 if mobile else 150
        p.rect(xx,yy,ww,118,WHITE,r=5,shadow=True);p.text(xx+15,yy+16,label,14,ww-44,lh=20);p.icon(xx+ww-31,yy+16,16,16,icon,YELLOW);p.text(xx+15,yy+67,count,32,100,bold=True,lh=38)
    y+=411 if mobile else 160
    p.group('Dernières demandes de devis');xx=20 if mobile else 55;ww=350 if mobile else 492;lefty=y;lh=452 if mobile else 648
    p.rect(xx,y,ww,lh,WHITE,r=5,shadow=True);p.text(xx+16,y+19,'Dernières demandes de devis',20 if not mobile else 19,ww-32,bold=True,lh=25)
    p.text(xx+ww-94,y+51 if mobile else y+19,'Tout voir',14,78,color=BLUE,align='right');yy=y+(84 if mobile else 53)
    for name,article,status,date,color in QUOTES:
        p.line(xx+16,yy,ww-32);yy+=17;p.text(xx+16,yy,name,16,ww-133,bold=True);p.text(xx+16,yy+25,article,14,ww-133)
        sw=88 if status=='Processing' else 74 if status=='Finished' else 42;p.button(xx+ww-sw-16,yy,sw,19,status,color,WHITE if color=='#198754' else INK,r=5,size=12,bold=True);p.text(xx+ww-115,yy+26,date,13,99,align='right');yy+=57
    if mobile:y+=lh+25;rx=20;ry=y;rw=350
    else:rx=568;ry=y;rw=492
    p.group('Derniers avis');reviewbox=p.rect(rx,ry,rw,648 if not mobile else 706,WHITE,r=5,shadow=True);p.text(rx+16,ry+19,'Derniers avis',20,rw-140,bold=True);p.text(rx+rw-94,ry+19,'Tout voir',14,78,color=BLUE,align='right');yy=ry+53
    for name,rating,status,color,review in ADMINREVIEWS:
        p.line(rx+16,yy,rw-32);yy+=17;p.text(rx+16,yy,name,16,rw-155,bold=True);stars(p,rx+rw-105,yy,rating,14);p.button(rx+rw-105,yy+23,89,18,status,color,INK if color==YELLOW else WHITE,r=5,size=12,bold=True)
        hh=p.text(rx+16,yy+48,review,14,rw-32,lh=21);yy+=48+hh+18
    reviewbox['h']=max(reviewbox['h'],yy-ry+10);y=max(ry+reviewbox['h'],lefty+lh)+43
    p.group('Accès rapides');y+=p.text(20 if mobile else 55,y,'Accès rapides',22,350 if mobile else 1005,bold=True)+19
    for i,(label,icon) in enumerate(zip(['Demandes de devis','Avis clients','Produits','Catégories','Utilisateurs'],['file-signature','star','shirt','layer-group','users'])):
        xx=20 if mobile else 55+i*204;yy=y+i*67 if mobile else y;ww=350 if mobile else 189;p.rect(xx,yy,ww,52,BG,INK,4,name='Accès rapide / '+label);p.icon(xx+20,yy+19,15,15,icon);p.text(xx+44,yy+17,label,14,ww-53,align='center',lh=20)
    y+=335 if mobile else 52
    return p.finish(y+80)

def svg_for(p,wire=False):
    scale=1 if p.mobile or p.id=='brief-client' else 1440/1115
    width=round(p.w*scale);height=math.ceil(p.h*scale)
    def col(c):
        if not wire:return c
        if c in (WHITE,BG):return WHITE
        if c in (LIGHT,'#EAE5DE',BORDER):return '#EEEEEE' if c==LIGHT else '#C8C8C8'
        if c in (INK,GRAY,'#777777','#6C757D'):return '#252525'
        return '#707070'
    result=[f'<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="{width}" height="{height}" viewBox="0 0 {p.w} {p.h}">',f'<title>{html.escape(p.title)} — {"Wireframe" if wire else "Maquette"} — {"Mobile" if p.mobile else "Desktop"}</title>',f'<rect width="{p.w}" height="{p.h}" fill="{col(p.background)}"/>','<defs><filter id="shadow" x="-10%" y="-10%" width="120%" height="125%"><feDropShadow dx="0" dy="2" stdDeviation="1.5" flood-color="#2C2522" flood-opacity="0.09"/></filter></defs>']
    group=None
    for i,n in enumerate(p.nodes):
        if n['group']!=group:
            if group is not None:result.append('</g>')
            group=n['group'];result.append(f'<g id="section-{i}" data-name="{html.escape(group,quote=True)}">')
        x,y,w,h=[n[k] for k in ['x','y','w','h']];typ=n['type'];name=html.escape(n['name'])
        if typ=='rect':
            result.append(f'<rect x="{x}" y="{y}" width="{w}" height="{h}" rx="{n["r"]}" fill="{col(n["fill"])}"'+(f' stroke="{col(n["stroke"])}"' if n.get('stroke') else '')+(' filter="url(#shadow)"' if n.get('shadow') and not wire else '')+f'><title>{name}</title></rect>')
        elif typ=='text':
            anchor='middle' if n['align']=='center' else 'end' if n['align']=='right' else 'start';tx=x+w/2 if anchor=='middle' else x+w if anchor=='end' else x
            result.append(f'<text font-family="{("Times New Roman, serif" if n["serif"] else "Arial, sans-serif")}" font-size="{n["size"]}" font-weight="{700 if n["bold"] else 400}" font-style="{"italic" if n["italic"] else "normal"}" fill="{col(n["color"])}" text-anchor="{anchor}" letter-spacing="{n["spacing"]}"><title>{name}</title>')
            for j,line in enumerate(n['lines']):result.append(f'<tspan x="{tx}" y="{y+n["size"]+j*n["lineHeight"]}">{html.escape(line)}</tspan>')
            result.append('</text>')
        elif typ=='image':
            if wire:
                result.append(f'<rect x="{x}" y="{y}" width="{w}" height="{h}" rx="{n["r"]}" fill="#DDDDDD" stroke="#BBBBBB"/><path d="M{x} {y}L{x+w} {y+h}M{x+w} {y}L{x} {y+h}" stroke="#B8B8B8"/>')
                sz=min(22,max(10,w/10));result.append(f'<rect x="{x+w/2-min(w*.42,90)}" y="{y+h/2-18}" width="{min(w*.84,180)}" height="36" fill="#DDDDDD"/><text x="{x+w/2}" y="{y+h/2+sz/3}" text-anchor="middle" font-family="Arial" font-size="{sz}" fill="#555555">{"LOGO" if "Logo" in n["name"] or "logo" in n["name"] else "IMAGE"}</text>')
            else:
                a=ASSETS[n['key']];clip=''
                if n['r']:
                    result.append(f'<clipPath id="clip-{i}"><rect x="{x}" y="{y}" width="{w}" height="{h}" rx="{n["r"]}"/></clipPath>');clip=f' clip-path="url(#clip-{i})"'
                result.append(f'<image x="{x}" y="{y}" width="{w}" height="{h}" preserveAspectRatio="xMidYMid meet" xlink:href="data:{a["mime"]};base64,{a["data"]}"{clip}><title>{name}</title></image>')
        else:
            result.append(f'<svg x="{x}" y="{y}" width="{w}" height="{h}" viewBox="{n["viewBox"]}" fill="{col(n["fill"])}">'+''.join(f'<path d="{d}"/>' for d in n['paths'])+'</svg>')
    if group is not None:result.append('</g>')
    result.append('</svg>');return ''.join(result),width,height

def native_screen(p,wire=False):
    scale=1 if p.mobile or p.id=='brief-client' else 1440/1115
    nd=copy.deepcopy(p.nodes)
    for n in nd:
        for k in ['x','y','w','h','r','size','lineHeight','spacing']:
            if k in n:n[k]*=scale
    return dict(id=p.id+('-mobile' if p.mobile else '-desktop')+('-wireframe' if wire else ''),name=p.title+' / '+('Mobile' if p.mobile else 'Desktop'),width=round(p.w*scale),height=math.ceil(p.h*scale),nodes=nd,background=p.background,page='01 — Brief & ressources' if p.id=='brief-client' else ('02 — Wireframes' if wire else '03 — Maquettes')+' / '+('Mobile' if p.mobile else 'Desktop'),wire=wire)

def brief():
    p=Page('brief-client','Brief client & ressources',background='#F1F1F1');p.w=5600
    for x,w in [(40,1420),(1500,1420),(2960,2600)]:p.rect(x,40,w,3600,WHITE)
    p.group('Brief client');x=100;y=100;y+=p.text(x,y,'Brief client — L’Aiguille des Volcans',38,1300,bold=True,serif=False)+44
    def block(x,y,title,body,w=1300):
        y+=p.text(x,y,title,30,w,bold=True,serif=False)+16;y+=p.text(x,y,body,23,w,serif=False,lh=34)+36;return y
    context=' '.join(CLIENT_PARAGRAPHS[1:4]);y=block(x,y,'Contexte',context)
    y=block(x,y,'Objectifs du site','Présenter les services et le savoir-faire artisanal.\nValoriser les réalisations par une galerie photographique.\nRenforcer la crédibilité et l’image de marque.\nFaciliter la prise de contact et les demandes de devis.\nDévelopper la visibilité et le référencement de l’atelier.\nOffrir une navigation simple sur ordinateur, tablette et smartphone.')
    y=block(x,y,'Arborescence retenue','Accueil → présentation, réalisations récentes, publics, avis\nÀ propos → histoire, savoir-faire, valeurs, atelier\nPrestations → quatre catégories de services\nGalerie → catégories et créations\nDemande de devis → projet, logo et coordonnées\nContact → coordonnées, rendez-vous, formulaire et carte\nDashboard admin → indicateurs, demandes, avis et accès rapides')
    y=block(x,y,'Direction artistique du client','« Moderne chic » ; couleurs claires, fond blanc, touches du doré du logo.\nUn site sobre, épuré et facile à comprendre.\nLes maquettes reprennent la composition des sept prints fournis.')
    y=block(x,y,'Périmètre de cette livraison','7 pages en desktop et mobile.\nWireframes et maquettes haute définition pour chaque page.\nDesktop : 1440 px ; mobile : 390 px.\nÉléments séparés pour l’importation dans Figma Design.\nBlog indiqué « ??? » dans le brief : non ajouté.\nMentions légales et confidentialité citées dans le brief :\nnon maquettées, car hors des sept pages demandées.')
    y=block(x,y,'Éléments à confirmer','Le PDF évoque une prestation « Broderie Minute » en 15 minutes.\nElle n’apparaît pas dans le print Prestations : conservée ici comme\ncontenu client à confirmer, sans ajout dans la maquette.\nContact : carte du document client, selon le choix confirmé.\nPrix, comptes et avis issus des prints. Le nom masqué de la troisième\ndemande admin est représenté par « Client » ; son statut est proposé.')
    p.group('Zoning et contenus');x=1560;y=100;y+=p.text(x,y,'Structure des sept pages',38,1300,bold=True,serif=False)+44
    blocks=[('01 — Accueil','Navigation principale et logo\nHero : « L’art du fil, la beauté du sur-mesure »\nPrésentation de l’atelier\nTrois réalisations récentes\nPour qui ? Particuliers, professionnels, associations\nTémoignages clients\nBandeau des quatre engagements'),('02 — À propos','Mon histoire avec portrait d’Océane\nMon savoir-faire avec photo de l’atelier\nMes valeurs : passion, qualité, écoute\nMachine à broder 15 couleurs\nLogiciel Wilcom et transformation du logo\nBroderie sur différents supports'),('03 — Prestations','Notre savoir-faire / titre / introduction\nBroderie personnalisée\nPersonnalisation textile et accessoires\nCouture et retouches\nCréation sur mesure\nAccès aux produits'),('04 — Galerie','Titre et introduction\nFiltres des quatre catégories\nSix créations : photo, titre, description, prix et bouton Voir\nGrille de trois colonnes sur desktop ; une sur mobile'),('05 — Demande de devis','Type d’article, origine, marquage, logo facultatif, quantité\nPrénom, nom, type et nom de l’organisme\nEmail, téléphone et description du projet\nFichiers images uniquement ; maximum 15 Mo\nBouton Envoyer'),('06 — Contact','Téléphone : 06 77 89 58 69\nAdresse : 4 Route de Clermont, 63530 Volvic\nFacebook et Instagram\nOuverture uniquement sur rendez-vous\nFormulaire : prénom, nom, entité, email et message\nEmplacement de la carte'),('07 — Dashboard admin','Navigation administrative et retour au site\nSix indicateurs\nDernières demandes de devis et statuts\nDerniers avis et modération\nCinq accès rapides')]
    for title,body in blocks:y=block(x,y,title,body)
    p.group('Identité & photographies');x=3020;y=100;y+=p.text(x,y,'Identité & ressources des prints',38,2480,bold=True,serif=False)+38
    p.image(x,y,880,250,'assets/images/logo_nav.png',name='Logo principal');p.rect(x+960,y,880,250,'#211E1C');p.image(x+960,y,880,250,'assets/images/logo_nav_dark.png',name='Logo sombre');y+=300
    p.text(x,y,'Couleurs observées',30,2400,bold=True,serif=False);y+=58
    for i,(name,c) in enumerate([('Fond',BG),('Doré',GOLD),('Texte',INK),('Surface',LIGHT),('Actions',BLUE)]):
        xx=x+i*490;p.rect(xx,y,430,100,c,'#DDDDDD');p.text(xx,y+121,name+' '+c,23,460,serif=False)
    y+=205;p.text(x,y,'Titres et contenus avec empattement • Navigation sans empattement',25,2450,serif=False);y+=80
    p.text(x,y,'Photographie du hero',30,2400,bold=True,serif=False);y+=60;p.image(x,y,2460,600,'assets/images/hero.png','cover');y+=666
    resources=[('oce.jpg','Océane'),('savoir.png','Savoir-faire'),('atelier_machine.jpg','Machine à broder'),('wilcom_logiciel.jpg','Logiciel Wilcom'),('broderie_support.jpg','Supports'),('recent1.jpg','Réalisation récente 01'),('recent2.jpg','Réalisation récente 02'),('recent3.jpg','Réalisation récente 03')]
    p.text(x,y,'Photographies utilisées',30,2400,bold=True,serif=False);y+=62
    for i,(im,label) in enumerate(resources):
        xx=x+(i%4)*625;yy=y+(i//4)*550;p.image(xx,yy,580,440,'assets/images/'+im);p.text(xx,yy+465,label,23,580,serif=False)
    height=max(3700,y+1100)
    for n in p.nodes:
        if n['type']=='rect' and n['y']==40 and n['h']==3600:n['h']=height-80
    return p.finish(height)

def write_page(p):
    for wire in [False,True]:
        folder=('03-wireframes-mobile' if p.mobile else '02-wireframes-desktop') if wire else ('05-maquettes-mobile' if p.mobile else '04-maquettes-desktop')
        content,w,h=svg_for(p,wire);target=OUT/folder/(p.id+'.svg');target.write_text(content,encoding='utf8');ET.parse(target);SCREENS.append(native_screen(p,wire))

pages=[]
for make in [accueil,about,prestations,galerie,devis,contact,dashboard]:
    for mobile in [False,True]:
        p=make(mobile)
        for n in p.nodes:
            assert n['x']>=0 and n['y']>=0 and n['x']+n['w']<=p.w+.5 and n['y']+n['h']<=p.h+.5,(p.id,mobile,n['name'],n)
            if n['type']=='text':
                f=font(n['size'],n['bold'],n['serif'],n['italic'])
                for line in n['lines']:assert f.getlength(line)+max(0,len(line)-1)*n['spacing']<=n['w']+1,(p.id,n['name'],line)
        write_page(p);pages.append(p)
b=brief();content,w,h=svg_for(b);(OUT/'01-brief/brief-client-et-ressources.svg').write_text(content,encoding='utf8');ET.parse(OUT/'01-brief/brief-client-et-ressources.svg');SCREENS.insert(0,native_screen(b))
(OUT/'importador-editavel/maquettes.json').write_text(json.dumps(dict(assets=ASSETS,screens=SCREENS),ensure_ascii=False,separators=(',',':')),encoding='utf8')
(OUT/'verification/controle.json').write_text(json.dumps(dict(sources=[p.name for p in SOURCE.glob('*.png')],pages=[dict(id=p.id,device='Mobile' if p.mobile else 'Desktop',width=round(p.w*(1 if p.mobile else 1440/1115)),height=math.ceil(p.h*(1 if p.mobile else 1440/1115)),elements=len(p.nodes)) for p in pages],svg_count=29,checks=['XML valide','Éléments des pages dans les limites','Textes des pages mesurés sans dépassement horizontal'],limits=['Import Figma non exécuté','Mobile adapté depuis les prints desktop','Nom masqué admin remplacé par Client ; statut proposé']),ensure_ascii=False,indent=2),encoding='utf8')
print('Créés : 29 SVG ;',len(ASSETS),'ressources photographiques ;',sum(len(p.nodes) for p in pages),'éléments sur les 14 maquettes.')
