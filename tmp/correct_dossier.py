from pathlib import Path
from copy import deepcopy
from zipfile import ZipFile
import hashlib, json, re
from lxml import etree
from docx import Document
from docx.shared import Inches, Pt, RGBColor
from docx.oxml import OxmlElement
from docx.oxml.ns import qn
from PIL import Image, ImageDraw, ImageFont

ROOT = Path.cwd()
SOURCE = ROOT / 'output/Aureo_Ruffier_Dossier_Professionnel.docx'
FINAL = ROOT / 'output/Aureo_Ruffier_Dossier_Professionnel_version_corrigee.docx'
TMP = ROOT / 'tmp/dossier_correction'
TMP.mkdir(parents=True, exist_ok=True)
NS = {'w':'http://schemas.openxmlformats.org/wordprocessingml/2006/main'}
def w(tag): return qn('w:'+tag)
def xp(element, expression): return etree.XPath(expression, namespaces=NS)(element)
doc = Document(SOURCE)
body = doc._element.body
sdts = body.xpath('.//w:sdt')
controls = {s.find('w:sdtPr/w:id',NS).get(w('val')): s for s in sdts}

def para(text, size=22, bold=False):
    p=OxmlElement('w:p'); pp=OxmlElement('w:pPr')
    spacing=OxmlElement('w:spacing'); spacing.set(w('after'),'45');spacing.set(w('line'),'240');spacing.set(w('lineRule'),'auto');pp.append(spacing)
    p.append(pp);r=OxmlElement('w:r');rp=OxmlElement('w:rPr')
    fonts=OxmlElement('w:rFonts');fonts.set(w('ascii'),'Arial');fonts.set(w('hAnsi'),'Arial');rp.append(fonts)
    sz=OxmlElement('w:sz');sz.set(w('val'),str(size));rp.append(sz)
    col=OxmlElement('w:color');col.set(w('val'),'000000');rp.append(col)
    if bold:rp.append(OxmlElement('w:b'))
    r.append(rp);t=OxmlElement('w:t');t.text=text;t.set('{http://www.w3.org/XML/1998/namespace}space','preserve');r.append(t);p.append(r)
    return p

def fill(id,text, size=22):
    s=controls[str(id)];pr=s.find('w:sdtPr',NS)
    for ph in pr.findall('w:showingPlcHdr',NS):pr.remove(ph)
    content=s.find('w:sdtContent',NS)
    # Cell-level rich text controls keep their cell geometry and editable control.
    cell=content.find('w:tc',NS)
    if cell is not None:
        for ch in list(cell):
            if ch.tag != w('tcPr'):cell.remove(ch)
        for line in text.split('\n'):cell.append(para(line,size,bold=line=='Compétences du référentiel :'))
    elif content.find('w:p',NS) is not None:
        for ch in list(content):content.remove(ch)
        for line in text.split('\n'):content.append(para(line,size))
    else:
        ts=xp(content,'.//w:t')
        if ts:
            ts[0].text=text
            for t in ts[1:]:t.text=''
        else:
            r=OxmlElement('w:r');t=OxmlElement('w:t');t.text=text;r.append(t);content.append(r)

FRONT='Développer la partie front-end d’une application web ou web mobile sécurisée'
BACK='Développer la partie back-end d’une application web ou web mobile sécurisée'
for id in ['2113311891','-723985950','1191953956']:fill(id,FRONT,20)
for id in ['-1772698536','-757595165','-241868907','-27186019','-1545441795']:fill(id,BACK,20)
fill('-832212218','Pokédex JS')
fill('-385645656', '''J’ai réalisé un prototype de Pokédex en JavaScript permettant d’afficher les Pokémon par génération et de rechercher un Pokémon par son nom ou son numéro.
J’ai structuré la page en HTML avec une barre de navigation, un menu des générations, un champ de recherche et une grille de cartes. J’ai utilisé Bootstrap et Font Awesome pour la présentation et l’adaptation aux différentes tailles d’écran.
En JavaScript natif, j’ai créé les boutons des neuf générations à partir d’une structure Map et généré les cartes dans le DOM. Les appels asynchrones à PokeAPI récupèrent les noms et les types des Pokémon. Les sprites changent au survol pour afficher leur version shiny.
Compétences du référentiel :
• Réaliser des interfaces utilisateur statiques web ou web mobile.
• Développer la partie dynamique des interfaces utilisateur web ou web mobile.''')
fill('-1115829704', 'Gestion de versions : GitHub.\nLangages : HTML, CSS et JavaScript.\nBibliothèques : Bootstrap et Font Awesome.\nAPI utilisée : PokeAPI.',21)
fill('-1354559711', '''J’ai développé le front-end de L’Aiguille des Volcans, un site présentant un atelier de broderie et de personnalisation textile. Il permet de découvrir les réalisations, de consulter le catalogue et de demander un devis.
À partir des documents de l’atelier, j’ai travaillé sur l’organisation des pages et les maquettes. Les wireframes et les maquettes pour ordinateur et mobile définissent la navigation, la place des images et les formulaires. J’ai repris le fond clair et les touches dorées de l’identité de l’atelier.
J’ai réalisé les pages avec HTML et Twig, en réutilisant une structure commune pour la navigation et le pied de page. Bootstrap 5 et le CSS personnalisé permettent d’adapter les grilles, les images et le menu aux différentes tailles d’écran.
J’ai intégré le catalogue et les formulaires de devis, de contact, d’inscription et de connexion. En JavaScript, j’ai ajouté le thème clair et sombre, l’agrandissement des photos et la prévisualisation des images dans l’administration. Webpack Encore compile les fichiers CSS et JavaScript.
Compétences du référentiel :
• Installer et configurer son environnement de travail en fonction du projet web ou web mobile.
• Maquetter des interfaces utilisateur web ou web mobile.
• Réaliser des interfaces utilisateur statiques web ou web mobile.
• Développer la partie dynamique des interfaces utilisateur web ou web mobile.''')
fill('-1507666235', 'Langages et templates : HTML, CSS, JavaScript et Twig.\nMaquetage : wireframes et maquettes SVG, versions ordinateur et mobile.\nBibliothèques : Bootstrap 5 et Font Awesome.\nOutils : Webpack Encore, npm et Docker Compose.\nFramework : Symfony.',21)
fill('-333382745', '''J’ai développé le back-end de L’Aiguille des Volcans avec PHP et Symfony pour gérer le catalogue, les utilisateurs, les devis et les avis.
J’ai modélisé les entités et leurs relations, puis créé la base MariaDB avec Doctrine et les migrations. Les produits sont associés aux catégories ; les avis et les devis peuvent être rattachés aux utilisateurs selon les règles du projet.
J’ai réalisé les requêtes d’affichage et l’administration pour ajouter, consulter, modifier et supprimer les données. Le formulaire de devis enregistre les coordonnées, les besoins et un logo facultatif, avec des contrôles de quantité, de type et de taille du fichier.
Les avis restent en attente avant approbation. L’inscription et la connexion utilisent le hachage des mots de passe. J’ai ajouté la protection CSRF de la connexion et des suppressions, ainsi que l’accès à l’administration réservé à ROLE_ADMIN. Le contact utilise Symfony Mailer.
J’ai configuré Docker avec PHP, Caddy, MariaDB, Node.js et phpMyAdmin. Les annexes présentent les relations entre entités et la procédure de mise en place locale, distincte d’une mise en production.
Compétences du référentiel :
• Mettre en place une base de données relationnelle.
• Développer des composants d’accès aux données SQL et NoSQL : utilisation de SQL avec Doctrine.
• Développer des composants métier côté serveur.''')
fill('-1234228067', 'Langage et framework : PHP 8.2 et Symfony 7.4.\nDonnées : MariaDB, Doctrine ORM, Doctrine Migrations et QueryBuilder.\nComposants : Symfony Form, Validator, Security et Mailer ; Twig.\nEnvironnement : Docker Compose, PHP-FPM, Caddy, Node.js et phpMyAdmin.\nDépendances et compilation : Composer, npm et Webpack Encore.\nModélisation : diagramme d’entités et de relations au format draw.io.',21)
fill('920906204', '''J’ai développé le back-end de Steamish, une application inspirée d’Instant Gaming permettant de consulter des jeux, des profils utilisateurs, des éditeurs et des catégories, ainsi que de déposer des avis.
J’ai modélisé les données, créé les entités Doctrine et leurs relations, puis les migrations pour la base MariaDB. J’ai développé les requêtes nécessaires à la recherche de jeux, à l’affichage des jeux les mieux notés, des jeux similaires et des informations de profil.
J’ai réalisé les contrôleurs et les formulaires Symfony, ainsi qu’un espace d’administration pour gérer les catégories, les éditeurs et les pays. J’ai ajouté l’authentification, le hachage des mots de passe, les contrôles de saisie et la protection de l’administration par le rôle ROLE_ADMIN.
J’ai séparé certaines opérations dans des services, notamment la génération des slugs. J’ai également travaillé sur l’internationalisation et les messages de confirmation ou d’erreur. Le développement s’est déroulé dans un environnement Docker.
Compétences du référentiel :
• Mettre en place une base de données relationnelle.
• Développer des composants d’accès aux données SQL et NoSQL : utilisation de SQL avec Doctrine.
• Développer des composants métier côté serveur.''')
fill('358319139', 'Gestion de versions : GitHub.\nLangage et framework : PHP 8.2 et Symfony 7.4.\nDonnées : MariaDB et Doctrine ORM.\nEnvironnement : Docker et phpMyAdmin.\nTemplates et compilation : Twig et Webpack Encore.',21)
fill('-818722276','PHP / SQL — Cocktails')
fill('1621407847', '''Lors d’un exercice de formation, j’ai développé une application en PHP permettant de rechercher des cocktails avec l’API TheCocktailDB et d’enregistrer ceux de son choix dans la base fournie pour l’exercice.
J’ai réalisé un formulaire envoyé en POST, puis récupéré et décodé la réponse JSON pour afficher les cocktails, leurs images et leurs ingrédients. Un message indique lorsqu’aucun résultat n’est trouvé.
Pour l’enregistrement, j’ai utilisé PDO et des requêtes préparées. Une requête SELECT vérifie si le cocktail est déjà présent avant son ajout avec INSERT. L’utilisateur est ensuite redirigé vers la liste des cocktails enregistrés.
J’ai réalisé la consultation des données sauvegardées et utilisé des fichiers communs pour l’en-tête et le pied de page. L’exercice porte sur l’ajout et la lecture des données ; il ne comprend pas de modification ni de suppression.
Compétences du référentiel :
• Développer des composants d’accès aux données SQL et NoSQL : utilisation de SQL avec PDO.
• Développer des composants métier côté serveur.''')
fill('-1214728916','Langages : PHP, SQL, HTML et CSS.\nBase de données : MySQL / MariaDB.\nAccès aux données : PDO et requêtes préparées.\nBibliothèque : Bootstrap.\nAPI utilisée : TheCocktailDB.\nFormat de données : JSON.',21)

# Complete known context; dates intentionally remain for the user to edit.
for id in ['1760476516','-812171436','128052569','-1425252255','477509099']:fill(id,'L’Institut de la PME',21)
contexts={
'-466733595':'Formation Développeur web et web mobile — exercice front-end Pokédex.',
'-1109205948':'Projet L’Aiguille des Volcans — maquetage et développement des interfaces.',
'-293835030':'Projet L’Aiguille des Volcans — base de données, traitements serveur et administration.',
'-756753207':'Formation Développeur web et web mobile — projet Steamish.',
'-958950546':'Formation Développeur web et web mobile — exercice PHP / SQL et API Cocktails.'}
for id,txt in contexts.items():fill(id,txt,21)
for id in ['-1312092629','-472066367']:fill(id,'J’ai travaillé seul sur le développement, à partir des documents de présentation et des besoins de l’atelier.',21)
for id in ['-809549014','-1956310916','-854728588']:fill(id,'J’ai travaillé seul sur ce projet avec l’accompagnement du formateur.',21)
for id in ['-111217832','957070149']:fill(id,'À compléter',20)
fill('304289194','',21)
fill('-157388396','Annexes 1 et 2 : extraits des wireframes et des maquettes pour ordinateur et mobile.',21)
fill('-1591304920','Annexe 3 : schéma actualisé des entités et de leurs relations.\nAnnexe 4 : procédure de mise en place locale de l’application.',21)
fill('-772866755','',21)
fill('-388882516','Le schéma de fonctionnement de l’exercice peut être présenté lors de l’entretien.',21)

# Remove the fourth example; preserve its actual content in the Docker annex.
tables=body.xpath('./w:tbl')
docker_table=tables[9]
following=docker_table.getnext()
body.remove(docker_table)
if following is not None and following.tag==w('p'):body.remove(following)

# Prevent inherited minimum heights from producing almost-empty continuation pages.
for table in body.xpath('./w:tbl')[4:-1]:
    # Optional section 5 is omitted; appendix references appear in the tools section.
    tr=table.findall('w:tr',NS)
    for row in tr[19:]:table.remove(row)
    for h in xp(table,'.//w:trHeight'):h.getparent().remove(h)
    for pp in xp(table,'.//w:pPr'):
        for v in pp.findall('w:pageBreakBefore',NS):pp.remove(v)
    # Keep labels with the following text, not every paragraph in the example.
    for p in xp(table,'.//w:p'):
        text=''.join(xp(p,'.//w:t/text()'))
        if text.startswith(('1. Décrivez','2. Précisez','3. Avec','4. Contexte','5. Informations')):
            pp=p.find('w:pPr',NS)
            if pp is None:pp=OxmlElement('w:pPr');p.insert(0,pp)
            pp.append(OxmlElement('w:keepNext'))

bookmark_id=600
def bookmark(p,name):
    global bookmark_id
    bookmark_id+=1
    start=OxmlElement('w:bookmarkStart');start.set(w('id'),str(bookmark_id));start.set(w('name'),name)
    end=OxmlElement('w:bookmarkEnd');end.set(w('id'),str(bookmark_id))
    p.insert(0,start);p.append(end)

example_tables=body.xpath('./w:tbl')[4:9]
names=['DP_Pokedex','DP_Front','DP_Back','DP_Steamish','DP_Cocktails']
for table,name in zip(example_tables,names):
    firstp=xp(table,'.//w:p')[0];bookmark(firstp,name)
    previous=table.getprevious()
    if previous is not None and previous.tag==w('p'):
        replacement=para('',2)
        pp=replacement.find('w:pPr',NS)
        pp.append(OxmlElement('w:pageBreakBefore'))
        pp.append(OxmlElement('w:keepNext'))
        spacing=pp.find('w:spacing',NS)
        spacing.set(w('before'),'0');spacing.set(w('after'),'0');spacing.set(w('line'),'20');spacing.set(w('lineRule'),'exact')
        previous.getparent().replace(previous,replacement)

# Update the table of contents using actual page reference fields.
toc=body.xpath('./w:tbl')[3];rows=toc.findall('w:tr',NS)
toc.remove(rows[10])
def cell_text(cell,txt,size=20):
    for ch in list(cell):
        if ch.tag!=w('tcPr'):cell.remove(ch)
    cell.append(para(txt,size))
def page_field(cell,name):
    cell_text(cell,'',20);p=cell.find('w:p',NS)
    f=OxmlElement('w:fldSimple');f.set(w('instr'),' PAGEREF '+name+' \\h ')
    r=OxmlElement('w:r');t=OxmlElement('w:t');t.text='';r.append(t);f.append(r);p.append(f)
for row_index,title,bm in [(3,'Pokédex JS','DP_Pokedex'),(4,'L’Aiguille des Volcans','DP_Front'),(7,'L’Aiguille des Volcans','DP_Back'),(8,'Steamish','DP_Steamish'),(9,'PHP / SQL — Cocktails','DP_Cocktails')]:
    cells=rows[row_index].findall('w:tc',NS);cell_text(cells[1],title);page_field(cells[-1],bm)
cell_text(rows[2].findall('w:tc',NS)[0],'Développer la partie front-end',20)
page_field(rows[2].findall('w:tc',NS)[-1],'DP_Pokedex')
cell_text(rows[6].findall('w:tc',NS)[0],'Développer la partie back-end',20)
page_field(rows[6].findall('w:tc',NS)[-1],'DP_Back')
page_field(rows[12].findall('w:tc',NS)[-1],'DP_Declaration')

# Make declaration text explicit, removing only redundant name/date overlay shapes.
for p in list(body):
    if p.tag!=w('p'):continue
    text=''.join(xp(p,'.//w:t/text()'))
    if text.startswith('Aureo PIRES') or text.startswith('CeyratCeyrat'):
        body.remove(p)
    elif text.startswith('Je soussigné(e)'):
        new=para('Je soussigné, Aureo PIRES PINHEIRO RUFFIER,',22);p.getparent().replace(p,new);bookmark(new,'DP_Declaration')
    elif text.startswith('Fait à'):
        new=para('Fait à Ceyrat, le 10/10/2026.',22);p.getparent().replace(p,new)

fill('-1507666235', 'Langages et templates : HTML, CSS, JavaScript et Twig.\nMaquetage : wireframes et maquettes SVG, ordinateur et mobile (annexes 1 et 2).\nBibliothèques : Bootstrap 5 et Font Awesome.\nOutils : Webpack Encore, npm et Docker Compose.\nFramework : Symfony.',21)
fill('-1234228067', 'Langage et framework : PHP 8.2 et Symfony 7.4.\nDonnées : MariaDB, Doctrine ORM, Doctrine Migrations et QueryBuilder.\nComposants : Symfony Form, Validator, Security et Mailer ; Twig.\nEnvironnement : Docker Compose, PHP-FPM, Caddy, Node.js et phpMyAdmin.\nDépendances et compilation : Composer, npm et Webpack Encore.\nModélisation et documentation : diagramme draw.io, schéma actualisé (annexe 3), procédure locale (annexe 4).',21)

# Remove surplus trailing empty paragraphs, preserving the existing signature drawing.
while len(body)>1:
    previous=body[-2]
    if previous.tag==w('p') and not xp(previous,'.//w:t|.//w:drawing|.//w:pict'):
        body.remove(previous)
    else:break

# Append source-derived annexes with concise captions.
for style in ['Normal','Heading 1','Heading 2','Title']:
    if style in doc.styles:
        st=doc.styles[style];st.font.color.rgb=RGBColor(0,0,0)

def heading(title,bm):
    doc.add_page_break();p=doc.add_paragraph(title)
    for r in p.runs:r.font.name='Arial';r.font.size=Pt(15);r.font.bold=True;r.font.color.rgb=RGBColor(0,0,0)
    p.paragraph_format.space_after=Pt(10);bookmark(p._p,bm)
def text(txt,size=11):
    p=doc.add_paragraph(txt);p.paragraph_format.space_after=Pt(7)
    for r in p.runs:r.font.name='Arial';r.font.size=Pt(size);r.font.color.rgb=RGBColor(0,0,0)
    return p
font_path='C:/Windows/Fonts/arial.ttf'
font_bold='C:/Windows/Fonts/arialbd.ttf'
def montage(desktop,mobile,name,crop_height,mobile_height=1550):
    im1=Image.open(desktop).convert('RGB');im2=Image.open(mobile).convert('RGB')
    im1=im1.crop((0,0,im1.width,min(im1.height,crop_height)))
    # Match displayed scale so desktop and mobile have readable text.
    im2=im2.crop((0,0,im2.width,min(im2.height,mobile_height)))
    im1.thumbnail((1080,1350));im2.thumbnail((390,1350))
    canvas=Image.new('RGB',(1530,max(im1.height,im2.height)+80),'white');d=ImageDraw.Draw(canvas)
    f=ImageFont.truetype(font_bold,28);d.text((15,12),'Ordinateur',font=f,fill='black');d.text((1130,12),'Mobile',font=f,fill='black')
    canvas.paste(im1,(0,65));canvas.paste(im2,(1130,65))
    path=TMP/name;canvas.save(path);return path

v=ROOT/'output/design/nouveaux-svg/verification'
heading('Annexe 1 Wireframes et maquettes de l’accueil','DP_Annexe1')
text('Les extraits ci-dessous présentent l’organisation de l’accueil sur ordinateur et mobile : navigation, présentation de l’atelier et accès aux prestations. Les versions complètes sont conservées dans les fichiers de maquetage du projet.')
a=montage(v/'02-wireframes-desktop/accueil.png',v/'03-wireframes-mobile/accueil.png','wireframes.png',800,720)
doc.add_picture(str(a),width=Inches(6.55))
text('Wireframes : structure des zones et adaptation de la navigation à la largeur de l’écran.',10)
a=montage(v/'04-maquettes-desktop/accueil.png',v/'05-maquettes-mobile/accueil.png','maquettes_accueil.png',800,720)
doc.add_picture(str(a),width=Inches(6.55))
text('Maquettes : fond clair, touches dorées, logo et photographies de l’atelier. Extraits des exports du projet.',10)

heading('Annexe 2 Maquettes du formulaire de devis','DP_Annexe2')
text('Le formulaire rassemble les informations nécessaires à une demande de personnalisation : article, marquage, quantité, logo éventuel, coordonnées et description du projet. La disposition des champs est adaptée à l’écran mobile.')
a=montage(v/'04-maquettes-desktop/demande-de-devis.png',v/'05-maquettes-mobile/demande-de-devis.png','maquettes_devis.png',1736)
doc.add_picture(str(a),width=Inches(6.55))
text('Extraits des maquettes du projet. Les écrans sont des représentations graphiques ; ils ne constituent pas une preuve de tests du formulaire.',10)

# Actual current relationships, including the nullable product on a review.
canvas=Image.new('RGB',(1800,1420),'white');d=ImageDraw.Draw(canvas)
f=ImageFont.truetype(font_path,26);fb=ImageFont.truetype(font_bold,30);fs=ImageFont.truetype(font_path,24)
def box(x,y,width,title,lines):
    height=74+len(lines)*36
    d.rectangle((x,y,x+width,y+height),outline='#444444',width=3)
    d.rectangle((x,y,x+width,y+52),fill='#ededed',outline='#444444',width=3)
    d.text((x+15,y+10),title,font=fb,fill='black')
    for i,line in enumerate(lines):d.text((x+15,y+68+i*36),line,font=f,fill='black')
    return height
box(30,30,480,'User',['id : int [clé primaire]','email : string [unique]','roles : array','password : string','firstName, lastName : string','createdAt : DateTimeImmutable','isVerified : bool'])
box(1010,30,660,'Review',['id : int [clé primaire]','content : text','rating : int (validation 1 à 5)','status : pending / approved / rejected','createdAt : DateTimeImmutable','user : User (obligatoire)','product : Product (facultatif)'])
box(30,710,700,'QuoteRequest',['id : int [clé primaire]','name, email, phone : string','articleType, articleOrigin : string','markingType, logo : string','quantity : int','organizationType / Name : string','message : text','status : new / processing / finished','createdAt : DateTimeImmutable','user : User (facultatif)'])
box(1020,620,650,'Product',['id : int [clé primaire]','title, slug : string','description : text (facultatif)','indicativePrice : int (facultatif)','image : string (facultatif)','isActive : bool','createdAt : DateTimeImmutable'])
box(1010,1130,660,'Category',['id : int [clé primaire]','name, slug : string','image, description : facultatifs'])
def line(points,labels):
    d.line(points,fill='#444444',width=3)
    for x,y,txt in labels:d.text((x,y),txt,font=fs,fill='black')
line([(510,170),(1010,170)],[(535,125,'1 User'),(825,125,'0..* avis')])
line([(270,356),(270,710)],[(290,390,'0..1 User'),(290,650,'0..* demandes')])
line([(1520,356),(1520,620)],[(1170,395,'0..* avis'),(1170,550,'0..1 Product')])
line([(1430,946),(1430,1130)],[(1050,975,'0..* produits / 0..* catégories')])
path=TMP/'schema_actualise.png';canvas.save(path)
heading('Annexe 3 Entités et relations de l’application','DP_Annexe3')
text('Le diagramme initial du projet est conservé au format draw.io. Cette synthèse est actualisée à partir des cinq entités Doctrine pour refléter les champs et les relations du code consulté le 11/10/2026.')
doc.add_picture(str(path),width=Inches(6.55))
text('La relation ManyToMany entre Product et Category utilise une table de liaison. Un avis appartient à un utilisateur et peut concerner un produit. Une demande de devis peut être envoyée sans compte utilisateur. Les types indiqués sont ceux des propriétés PHP ; les champs facultatifs correspondent aux colonnes nullable.',10)

heading('Annexe 4 Mise en place locale avec Docker','DP_Annexe4')
text('Cette procédure décrit la mise en place de l’environnement local de L’Aiguille des Volcans à partir de compose.yaml et du Dockerfile du projet. Elle ne décrit pas une mise en production et n’atteste pas d’une exécution des étapes lors de la correction du dossier.')
text('1. Préparer les outils et la configuration',12).runs[0].bold=True
text('Installer Docker avec Docker Compose et récupérer les fichiers du projet. Vérifier les variables d’environnement, notamment DATABASE_URL et le transport du mailer. La base locale s’appelle db_broderie ; depuis le conteneur PHP, le serveur de base de données est mariadb sur le port 3306.')
text('2. Construire et démarrer les services',12).runs[0].bold=True
text('Exécuter docker compose up -d --build. Le fichier Compose définit PHP-FPM, Caddy, MariaDB, Node.js et phpMyAdmin. Le service Node installe les dépendances et lance npm run watch. Les données MariaDB sont conservées dans un volume.')
text('3. Installer les dépendances et préparer la base',12).runs[0].bold=True
for cmd in ['docker compose exec php composer install','docker compose exec php php bin/console doctrine:database:create --if-not-exists','docker compose exec php php bin/console doctrine:migrations:migrate --no-interaction','docker compose exec node npm run build']:
    text(cmd,10)
text('Pour une base locale de démonstration uniquement, les fixtures peuvent être chargées avec doctrine:fixtures:load. Cette commande efface les données existantes : elle ne doit pas être utilisée sur une base à conserver.',10)
text('4. Vérifier la configuration locale',12).runs[0].bold=True
text('Le site est exposé sur https://localhost:8443 et phpMyAdmin sur le port 8080. Caddy utilise un certificat local. Contrôler le démarrage des services, l’accès à la base, l’affichage du catalogue et le fonctionnement des formulaires. L’envoi de messages exige un transport de messagerie configuré.')
text('5. Distinguer le développement de la production',12).runs[0].bold=True
text('La configuration actuelle utilise des identifiants de développement et expose des outils locaux. Une mise en production exige une configuration dédiée : secrets, droits de la base, domaine et certificat, sauvegardes, dépendances et cache de production. Cette étape reste à documenter et à valider séparément.')

# Add annexes to the original contents table.
for title,bm in [('Annexe 1 — Wireframes et accueil','DP_Annexe1'),('Annexe 2 — Formulaire de devis','DP_Annexe2'),('Annexe 3 — Entités et relations','DP_Annexe3'),('Annexe 4 — Environnement local','DP_Annexe4')]:
    new=deepcopy(rows[12]);cells=new.findall('w:tc',NS);cell_text(cells[0],title,19);page_field(cells[-1],bm);toc.append(new)

settings=doc.settings.element
upd=settings.find(w('updateFields'))
if upd is None:upd=OxmlElement('w:updateFields');settings.append(upd)
upd.set(w('val'),'true')
doc.save(FINAL)
print(FINAL)
print('SOURCE_SHA256',hashlib.sha256(SOURCE.read_bytes()).hexdigest())
