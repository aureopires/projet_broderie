from pathlib import Path
from zipfile import ZipFile, ZIP_DEFLATED
from copy import deepcopy
from lxml import etree

root=Path.cwd()
source=root/'output/Aureo_Ruffier_Dossier_Professionnel.docx'
base=root/'output/Antigos/Aureo_Ruffier_Dossier_Professionnel base.docx'
out=root/'output/Aureo_Ruffier_Dossier_Professionnel_sans_annexes.docx'
ns={'w':'http://schemas.openxmlformats.org/wordprocessingml/2006/main'}
W='{'+ns['w']+'}'
def xp(e,q):return e.xpath(q,namespaces=ns)
def txt(e):return ''.join(xp(e,'.//w:t/text()'))
def p(text):
 e=etree.Element(W+'p');pr=etree.SubElement(e,W+'pPr');sp=etree.SubElement(pr,W+'spacing');sp.set(W+'after','45');sp.set(W+'line','240')
 r=etree.SubElement(e,W+'r');rp=etree.SubElement(r,W+'rPr');f=etree.SubElement(rp,W+'rFonts');f.set(W+'ascii','Arial');f.set(W+'hAnsi','Arial');s=etree.SubElement(rp,W+'sz');s.set(W+'val','22');t=etree.SubElement(r,W+'t');t.text=text
 return e
def setcontrol(s,text):
 c=s.find('w:sdtContent',ns);cell=c.find('w:tc',ns)
 if cell is not None:
  for ch in list(cell):
   if ch.tag!=W+'tcPr':cell.remove(ch)
  for line in text.split('\n'):cell.append(p(line))
 else:
  ts=xp(c,'.//w:t')
  if ts:
   ts[0].text=text
   for t in ts[1:]:t.text=''
 for ph in xp(s,'./w:sdtPr/w:showingPlcHdr'):ph.getparent().remove(ph)

with ZipFile(source) as z:parts={i.filename:z.read(i.filename) for i in z.infolist()}
t=etree.fromstring(parts['word/document.xml']);body=t.find('w:body',ns)
# Remove appendix content and its preceding page break, preserve signature.
children=list(body)
first=next(i for i,e in enumerate(children) if txt(e).startswith('Annexe 1'))
start=first-1 if children[first-1].tag==W+'p' and not txt(children[first-1]) else first
for e in children[start:]:
 if e.tag!=W+'sectPr':body.remove(e)
for s in xp(body,'.//w:sdt'):
 text=txt(s)
 if 'Maquetage :' in text and 'annexes' in text.lower():
  setcontrol(s,'Langages et templates : HTML, CSS, JavaScript et Twig.\nMaquetage : wireframes et maquettes SVG, ordinateur et mobile.\nBibliothèques : Bootstrap 5 et Font Awesome.\nOutils : Webpack Encore, npm et Docker Compose.\nFramework : Symfony.')
 elif 'J’ai développé le back-end de L’Aiguille' in text:
  # Preserve the existing concise description, changing only the appendix sentence.
  for e in xp(s,'.//w:t'):
   if 'Les annexes présentent' in (e.text or ''):
    e.text='J’ai configuré Docker avec PHP, Caddy, MariaDB, Node.js et phpMyAdmin.'
 elif 'Modélisation et documentation :' in text:
  setcontrol(s,'Langage et framework : PHP 8.2 et Symfony 7.4.\nDonnées : MariaDB, Doctrine ORM, Doctrine Migrations et QueryBuilder.\nComposants : Symfony Form, Validator, Security et Mailer ; Twig.\nEnvironnement : Docker Compose, PHP-FPM, Caddy, Node.js et phpMyAdmin.\nDépendances et compilation : Composer, npm et Webpack Encore.\nModélisation : diagramme des entités et de leurs relations au format draw.io.')

with ZipFile(base) as z:old=etree.fromstring(z.read('word/document.xml'))
docker=deepcopy(next(e for e in xp(old,'./w:body/w:tbl') if 'Exemple n°4' in txt(e)))
for s in xp(docker,'.//w:sdt'):
 text=txt(s);tag=xp(s,'./w:sdtPr/w:tag/@w:val')
 if tag and tag[0]=='1.Décrire tâches effectuées':
  setcontrol(s,'J’ai préparé un environnement de développement avec Docker pour exécuter une application PHP et sa base de données.\nJ’ai rédigé un Dockerfile pour construire l’image PHP et installer les dépendances nécessaires. J’ai ensuite configuré les services avec Docker Compose, notamment le serveur PHP et la base MariaDB.\nJ’ai ajouté un conteneur phpMyAdmin pour consulter les tables et les données pendant le développement. Les fichiers de configuration permettent de définir les services et de reproduire l’environnement du projet.\nCompétences du référentiel :\n• Installer et configurer son environnement de travail en fonction du projet web ou web mobile.\n• Documenter le déploiement d’une application dynamique web ou web mobile : préparation des fichiers de configuration Docker.')
 elif tag and tag[0]=='2.Préciser les moyens utilisés':setcontrol(s,'Conteneurisation : Docker, Dockerfile et Docker Compose.\nEnvironnement serveur : PHP et MariaDB.\nAdministration de la base : phpMyAdmin.')
 elif 'Cliquez ici' in text:
  alias=xp(s,'./w:sdtPr/w:alias/@w:val')
  if 'entreprise' in str(tag+alias).lower():setcontrol(s,'L’Institut de la PME')
  elif 'Chantier' in str(tag+alias):setcontrol(s,'Formation Développeur web et web mobile — préparation d’un environnement avec Docker.')
  else:setcontrol(s,'')
for h in xp(docker,'.//w:trHeight'):h.getparent().remove(h)
for row in list(docker.findall('w:tr',ns))[19:]:docker.remove(row)
for s in xp(docker,'.//w:sdt'):
 if txt(s)=='Développer le back end d’une application web ou web mobile sécurisée':setcontrol(s,'Développer la partie back-end d’une application web ou web mobile sécurisée')
paragraph=xp(docker,'.//w:p')[0]
bs=etree.Element(W+'bookmarkStart');bs.set(W+'id','9001');bs.set(W+'name','DP_Docker');paragraph.insert(0,bs)
be=etree.SubElement(paragraph,W+'bookmarkEnd');be.set(W+'id','9001')
tables=xp(body,'./w:tbl');declaration=tables[-1]
separator=p('');pr=separator.find('w:pPr',ns);etree.SubElement(pr,W+'pageBreakBefore');etree.SubElement(pr,W+'keepNext');pr.find('w:spacing',ns).set(W+'line','20');pr.find('w:spacing',ns).set(W+'after','0')
before=declaration.getprevious();body.insert(body.index(before),separator);body.insert(body.index(before),docker)

toc=tables[3]
for row in list(toc):
 if row.tag==W+'tr' and 'Annexe' in txt(row):toc.remove(row)
declrow=next(r for r in toc.findall('w:tr',ns) if 'Déclaration sur l’honneur' in txt(r))
new=deepcopy(declrow)
cells=new.findall('w:tc',ns)
for ch in list(cells[0]):
 if ch.tag!=W+'tcPr':cells[0].remove(ch)
cells[0].append(p('Docker'))
for instr in xp(new,'.//w:instrText'):
 if 'PAGEREF' in (instr.text or ''):instr.text=' PAGEREF DP_Docker \\h '
for f in xp(new,'.//w:fldSimple'):f.set(W+'instr',' PAGEREF DP_Docker \\h ')
toc.insert(toc.index(declrow),new)
assert not any('annexe' in (e.text or '').lower() for e in xp(t,'.//w:t') if e.getparent() is not None and e.text and e.text.startswith(('Annexe','Les annexes','Modélisation et')))
parts['word/document.xml']=etree.tostring(t,xml_declaration=True,encoding='UTF-8',standalone=True)
with ZipFile(out,'w',ZIP_DEFLATED) as z:
 for name,data in parts.items():z.writestr(name,data)
print(out)
