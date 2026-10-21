from pathlib import Path
from zipfile import ZipFile, ZIP_DEFLATED
from lxml import etree as E
from PIL import Image, ImageDraw, ImageFont
import posixpath
src=Path('output/dossier_projet/Aureo_Ruffier_Dossier_Projet_DWWM.docx')
out=src.with_name('Aureo_Ruffier_Dossier_Projet_DWWM_controles_actualises.docx')
stamp='2026-10-18_14-36-39'
logs={k:Path(f'output/tests/{k}-{stamp}.txt').read_text(encoding='utf-8-sig') for k in ['phpunit','doctrine','twig']}
assert 'OK (63 tests, 229 assertions)' in logs['phpunit']
assert 'schema is in sync' in logs['doctrine']
assert 'All 54 Twig files contain valid syntax.' in logs['twig']
with ZipFile(src) as z:data={n:z.read(n) for n in z.namelist()}
ns={'w':'http://schemas.openxmlformats.org/wordprocessingml/2006/main','a':'http://schemas.openxmlformats.org/drawingml/2006/main','r':'http://schemas.openxmlformats.org/officeDocument/2006/relationships'}
q=lambda s:'{'+ns['w']+'}'+s
root=E.fromstring(data['word/document.xml'])
def txt(p):return ''.join(p.xpath('.//w:t/text()',namespaces=ns))
def replace(p,t):
 ts=p.xpath('.//w:t',namespaces=ns);ts[0].text=t
 for x in ts[1:]:x.text=''
changes=0
for p in root.xpath('//w:body/w:p',namespaces=ns):
 t=txt(p)
 if t.startswith('La suite PHPUnit a été exécutée'):
  replace(p,'Le 18 octobre 2026 à 14 h 36, heure de Paris, trois contrôles complémentaires ont été exécutés dans l’environnement local. PHPUnit : 63 tests et 229 assertions réussis. Doctrine : mappage des entités valide et schéma de la base synchronisé. Twig : syntaxe valide pour les 54 templates contrôlés. Les rapports complets sont conservés dans output/tests, sous les noms phpunit-2026-10-18_14-36-39.txt, doctrine-2026-10-18_14-36-39.txt et twig-2026-10-18_14-36-39.txt. Ces résultats portent sur les scénarios automatisés, la structure des données et la syntaxe ; ils ne remplacent pas les vérifications visuelles du site.');changes+=1
 elif t.startswith('Extrait de la sortie réelle du 17 octobre'):
  replace(p,'Extraits des sorties réelles des trois contrôles du 18 octobre 2026 à 14 h 36, reproduits depuis les rapports texte. Les lignes intermédiaires sont omises.')
  before=p.getprevious()
  while before is not None and not before.xpath('.//a:blip',namespaces=ns):before=before.getprevious()
  rid=before.xpath('.//a:blip/@r:embed',namespaces=ns)[0];changes+=1
 elif t.startswith('La commande ci-dessous exécute la suite existante'):
  replace(p,'La commande ci-dessous exécute la suite PHPUnit existante dans le service PHP de Docker. Les contrôles Doctrine et Twig ont été lancés séparément avec doctrine:schema:validate et lint:twig templates. Chaque rapport texte conserve la sortie complète du contrôle correspondant.');changes+=1
 elif t.startswith('Ces résultats proviennent de la suite locale exécutée le 17 octobre'):
  replace(p,t.replace('17 octobre','18 octobre'));changes+=1
assert changes==4,changes
rels=E.fromstring(data['word/_rels/document.xml.rels'])
target=next(x.get('Target') for x in rels if x.get('Id')==rid)
media=posixpath.normpath(posixpath.join('word',target))
lines=['Contrôles locaux — 18 octobre 2026, 14 h 36 (Paris)',
'PHPUnit : php bin/phpunit --testdox --colors=never',
next(x for x in logs['phpunit'].splitlines() if x.startswith('OK (')),'',
'Doctrine : php bin/console doctrine:schema:validate --no-ansi',
*[x.strip() for x in logs['doctrine'].splitlines() if '[OK]' in x],'',
'Twig : php bin/console lint:twig templates --no-ansi',
next(x.strip() for x in logs['twig'].splitlines() if '[OK]' in x)]
im=Image.new('RGB',(1480,410),'white');draw=ImageDraw.Draw(im);font=ImageFont.truetype('C:/Windows/Fonts/consola.ttf',23)
for i,line in enumerate(lines):draw.text((22,18+i*37),line,font=font,fill='#111111')
imagepath=Path('output/tests/extrait-controles-2026-10-18.png');im.save(imagepath)
assert media.endswith('.png'),media
data[media]=imagepath.read_bytes();data['word/document.xml']=E.tostring(root,encoding='UTF-8',xml_declaration=True,standalone=True)
with ZipFile(out,'w',ZIP_DEFLATED) as z:
 for n,b in data.items():z.writestr(n,b)
with ZipFile(src) as z:
 changed=[n for n,b in data.items() if z.read(n)!=b]
assert set(changed)=={'word/document.xml',media}
from docx import Document
Document(out)
print(out.resolve());print('Verified: only four paragraphs and existing evidence image changed. All other document parts preserved. No PDF created.')
