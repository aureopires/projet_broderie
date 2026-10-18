from pathlib import Path
import re,shutil,json
ROOT=Path.cwd()
target=ROOT/'output/dossier_projet/Aureo_Ruffier_Dossier_Projet_DWWM.docx'
if target.exists() and not (ROOT/'tmp/jury/ancien_dossier.docx').exists():shutil.copy2(target,ROOT/'tmp/jury/ancien_dossier.docx')
base=(ROOT/'tmp/dossier/build.py').read_text(encoding='utf8').split("para('TITRE PROFESSIONNEL")[0]
base=base.replace("ROOT/'tmp/dossier/contenu.txt'","ROOT/'tmp/jury/contenu.txt'")
base=base.replace("([2.2,2.85,1.85] if n==3 else [2.65,1.42,1.42,1.41])","([2.35,4.55] if n==2 else ([3.25,2.4,1.25] if n==3 else [2.65,1.42,1.42,1.41]))")
exec(base)
styles['Normal'].font.size=Pt(11.5)
styles['Normal'].paragraph_format.line_spacing=1.08
styles['Heading 2'].font.size=Pt(16)
styles['Heading 2'].paragraph_format.space_after=Pt(12)
styles['Heading 1'].font.size=Pt(20)
styles['Heading 1'].paragraph_format.space_after=Pt(10)
styles['TocEntry'].font.size=Pt(10.5)
styles['TocEntry'].paragraph_format.space_after=Pt(6)

oldbody=body
from PIL import ImageDraw
q=Image.open(ROOT/'tmp/jury/figures/quote.png')
panel=Image.new('RGB',(1740,700),'white')
panel.paste(q.crop((250,140,1120,670)),(0,40))
panel.paste(q.crop((250,675,1120,1295)),(870,40))
ImageDraw.Draw(panel).text((15,10),'1  Caractéristiques du projet',fill='black')
ImageDraw.Draw(panel).text((885,10),'2  Coordonnées et message',fill='black')
panel.save(ROOT/'tmp/jury/figures/quote-extraits.png')
oldpic=pic
def pic(path,caption,maxh):
 if path=='tmp/jury/figures/quote.png':
  path='tmp/jury/figures/quote-extraits.png';caption='Figure 12 Deux extraits du formulaire actuel de devis'
 limits={'Figure 4':1.5,'Figure 5':1.9,'Figure 6':2.6,'Figure 11':2.8,'Figure 12':2.5,'Figure 13':1.75,'Figure 14':2.5,'Figure 15':2.5,'Figure 17':2.25,'Figure 19':1.95}
 for key,value in limits.items():
  if caption.startswith(key+' '):maxh=min(float(maxh),value)
 return oldpic(path,caption,maxh)
def body(txt):
 chunks=re.split(r'(@literal:.*?@endliteral)',txt,flags=re.S)
 for chunk in chunks:
  if chunk.startswith('@literal:'):
   for line in chunk[len('@literal:'):].replace('@endliteral','').strip().splitlines():
    p=para(line,'Code');p.paragraph_format.keep_with_next=True
   para('')
  else:oldbody(chunk)

para('TITRE PROFESSIONNEL DWWM   RNCP 37674').runs[0].font.size=Pt(11)
para('Dossier de projet','Title')
para('L’Aiguille des Volcans','Subtitle').runs[0].font.size=Pt(25)
para('Site web de broderie et de personnalisation textile').runs[0].font.size=Pt(14)
pic('tmp/jury/figures/home.png','Application Symfony et base de données MariaDB',3.45)
para('Aureo Ruffier').runs[0].bold=True
para('L’Institut de la PME\nFormation du 4 mai au 14 août 2026\nSoutenance du 29 octobre 2026')
para('Titre professionnel Développeur web et web mobile\nRéalisation individuelle').runs[0].font.size=Pt(12)
para('Dossier préparé le 13 octobre 2026','Source')

sections=[]
for i,(title,txt) in enumerate(pages):
 subtitle=re.search(r'^## (.*)',txt,re.M).group(1)
 sections.append((title,subtitle,txt,i+4))

for start,end in [(0,17),(17,34)]:
 d.add_page_break();d.add_heading('Sommaire' if start==0 else 'Sommaire suite',1)
 for title,subtitle,txt,num in sections[start:end]:
  if re.match(r'^[IVX]+ ',title):
   p=para(title,'TocEntry');p.runs[0].bold=True
  p=para(subtitle,'TocEntry');p.paragraph_format.tab_stops.add_tab_stop(Inches(6.7),WD_ALIGN_PARAGRAPH.RIGHT);p.add_run('\t'+str(num))
 if start:
  for title,num in [('Annexe A Maquette du devis sur ordinateur',38),('Annexe B Maquette du devis sur mobile',39),('Annexe C Sources et repères techniques',40),('Annexe D Exemple SQL et jeu d’essai',41)]:
   p=para(title,'TocEntry');p.paragraph_format.tab_stops.add_tab_stop(Inches(6.7),WD_ALIGN_PARAGRAPH.RIGHT);p.add_run('\t'+str(num))

additions={
7:"\nLes textes courants utilisent une police à empattements, avec Georgia et une police de remplacement. La navigation utilise une police système sans empattements. Cette différence distingue les textes de présentation des commandes de l’interface. Les variables CSS regroupent les couleurs afin de les réutiliser et de les adapter au thème sombre.\n@code:assets/styles/page/page.css|:root {|9\n",
12:"\nUne mise à jour suit un cycle simple : modifier les fichiers, vérifier le résultat, créer un commit puis envoyer les changements avec un push. La publication sur OVH reste une opération distincte du push GitHub. Le dépôt actualisé ne modifie donc pas automatiquement le site hébergé.\n",
15:"\nPour préparer un environnement local, les principales étapes sont l’installation des dépendances, la configuration de la connexion, la création de la base puis l’application des migrations. Les commandes Symfony permettent de décrire ces actions et d’en contrôler le résultat.\n@literal:php bin/console doctrine:database:create\nphp bin/console doctrine:migrations:migrate\nphp bin/console doctrine:schema:validate\n@endliteral\nCes commandes sont exécutées dans l’environnement PHP du projet. Le chargement de fixtures est réservé à une base de démonstration, car il peut remplacer son contenu.\n",
18:"\nL’attribut min aide la saisie dans le navigateur. NotBlank et GreaterThanOrEqual vérifient réellement la quantité sur le serveur. L’extrait suivant montre cette différence.\n@code:src/Form/QuoteRequestType.php|->add('quantity'|9\n",
19:"\nL’extrait ci-dessous montre l’état initial de la demande et l’écriture. persist prépare l’objet pour Doctrine ; flush exécute les opérations nécessaires dans la base. En cas d’échec, le fichier associé est retiré avant de transmettre l’erreur.\n@code:src/Controller/Front/QuoteRequestController.php|$quoteRequest->setCreatedAt|10\n",
22:"\nL’adresse du compte est unique. Le formulaire et les règles de l’entité permettent de contrôler la création avant d’enregistrer les données. Pour le hachage, le traitement utilise le service prévu par Symfony.\n@code:src/Controller/Front/RegistrationController.php|hashPassword(|4\n",
24:"\nDans cet extrait, la boucle crée un lien pour chaque catégorie reçue. path construit l’adresse de la route à partir de son nom et du slug. Le template peut ainsi présenter des catégories qui évoluent dans la base.\n@code:templates/front/product/index.html.twig|{% for category in categories %}|6\n",
27:"\nL’extrait ci-dessous applique le thème choisi puis met à jour le bouton. Le changement de classe sur body permet au CSS d’utiliser les couleurs du thème sombre.\n@code:assets/scripts/theme.js|const setTheme|5\n",
32:"\nUn exemple concret de correction concerne les catégories : toutes les entrées publiques doivent exclure les produits inactifs. J’ai regroupé la logique de recherche dans le repository et vérifié les routes concernées. Pour le devis, les contrôles de saisie ont été renforcés afin que la validation ne dépende pas seulement des attributs HTML. Ces corrections sont illustrées par les extraits et les tests présentés plus haut.\n"
}

for i,(title,subtitle,txt,num) in enumerate(sections,1):
 d.add_page_break()
 if re.match(r'^[IVX]+ ',title):d.add_heading(title,1)
 body(txt+additions.get(i,''))

d.add_page_break();d.add_heading('Annexe A Maquette du devis sur ordinateur',1)
para('Maquette issue des exports graphiques du projet Figma. Elle présente l’intention de conception du formulaire avant les ajustements de l’intégration. Le fonctionnement actuel est présenté dans les captures des chapitres de développement.')
pic('tmp/dossier/maquette-web.png','Figure A1 Maquette complète du devis sur ordinateur',7.8)

d.add_page_break();d.add_heading('Annexe B Maquette du devis sur mobile',1)
para('Les deux parties se lisent de gauche à droite et correspondent à la progression verticale du formulaire. Les champs et les choix ont ensuite été reliés au formulaire Symfony.')
pic('tmp/dossier/maquette-mobile.png','Figure B1 Maquette mobile du devis en deux parties',7.9)

d.add_page_break();d.add_heading('Annexe C Sources et repères techniques',1)
para('Les références ci-dessous servent à comprendre le cadre du titre et les outils utilisés. Le dossier d’exemple a été utilisé comme repère de structure, avec un contenu entièrement adapté à L’Aiguille des Volcans.')
for t in [
'Référentiel DWWM 2023 TP 01280 millésime 04 et référentiel d’évaluation fournis dans les supports de formation.',
'Fiche RNCP 37674 France compétences\nhttps://www.francecompetences.fr/recherche/rncp/37674/',
'Documentation officielle Symfony\nhttps://symfony.com/doc/7.4/forms.html\nhttps://symfony.com/doc/7.4/security.html\nhttps://symfony.com/doc/7.4/security/csrf.html',
'Documentation Doctrine ORM\nhttps://www.doctrine-project.org/projects/doctrine-orm/en/3.6/index.html',
'CNIL Principes de protection des données\nhttps://www.cnil.fr/fr/les-six-grands-principes-du-rgpd',
'OWASP File Upload Cheat Sheet\nhttps://cheatsheetseries.owasp.org/cheatsheets/File_Upload_Cheat_Sheet.html',
'Dépôt du projet\nhttps://github.com/aureopires/projet_broderie',
'Maquettes Figma\nhttps://www.figma.com/design/oWgNwwsssc6BPxEEJrHwZl/L-Aiguille-des-Volcans',
'Supports personnels utilisés : présentation Aureo_Ruffier_Presentation_Projet.pptx, Diagram.png, Designer.png et exports des maquettes. Exemple de structure : dossier de Corentin Polard fourni par le candidat.'
]:
 p=para(t);p.paragraph_format.space_after=Pt(7);p.runs[0].font.size=Pt(9.5)
para('Repères de vocabulaire','Heading 2')
para('Route : adresse associée à une action. Repository : classe qui rassemble les recherches de données. ORM : outil qui relie des objets aux tables. Migration : évolution enregistrée de la structure SQL. CSRF : protection des actions contre une demande forgée depuis un autre site. Responsive : adaptation de la disposition à la largeur de l’écran. Slug : identifiant lisible utilisé dans une adresse.').runs[0].font.size=Pt(10)

d.add_page_break();d.add_heading('Annexe D Exemple SQL et jeu d’essai',1)
para('La création de Category est conservée dans la migration Version20260729074248. Voici sa commande SQL, remise en lignes pour la lecture. Elle illustre une clé primaire et des champs facultatifs. Les autres migrations complètent la structure et les relations.')
body('''@literal:CREATE TABLE category (
    id INT AUTO_INCREMENT NOT NULL,
    name VARCHAR(255) NOT NULL,
    image VARCHAR(255) DEFAULT NULL,
    slug VARCHAR(255) NOT NULL,
    description LONGTEXT DEFAULT NULL,
    PRIMARY KEY (id)
) DEFAULT CHARACTER SET utf8mb4;
@endliteral''')
para('La table product_category relie un produit à plusieurs catégories. Sa clé primaire composée évite de répéter deux fois la même association. Les clés étrangères définies dans la migration relient ses identifiants aux tables Product et Category.')
d.add_heading('Un exemple de validation du devis',2)
para('Le test QuoteRequestTypeTest utilise une demande fictive : douze polos fournis par le client avec un motif brodé. Le logo et le nom d’organisme peuvent rester absents. Les autres champs reçoivent des valeurs valides.')
code('tests/Form/QuoteRequestTypeTest.php|private const VALID_DATA|7')
table([['Variation du jeu de données','Attendu','Obtenu'],['Données valides ci-dessus','Formulaire valide','Valide'],['Même demande avec quantity = 0','Formulaire invalide','Invalide'],['Même demande avec email = invalide','Formulaire invalide','Invalide']])
para('Ces résultats proviennent de la suite locale exécutée le 13 octobre 2026. Dans le test isolé du formulaire, le CSRF est désactivé pour cibler les contraintes de saisie. Les protections des parcours sont vérifiées séparément par les tests des contrôleurs.').runs[0].font.size=Pt(10)

d.core_properties.title='Dossier de projet L’Aiguille des Volcans'
d.core_properties.author='Aureo Ruffier'
d.core_properties.subject='Titre professionnel Développeur web et web mobile RNCP 37674'
d.save(target)
print(json.dumps({'body_pages':34,'planned_pages':41,'words':len(raw.split()),'output':str(target)},ensure_ascii=False))
