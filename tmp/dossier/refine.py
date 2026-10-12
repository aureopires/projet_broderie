from pathlib import Path
from PIL import Image
p=Path('tmp/dossier/contenu.txt');s=p.read_text(encoding='utf8')
s=s.replace('output/design/nouveaux-svg/verification/wireframes-mobile.png|Figure 3 Planche de wireframes mobiles présente dans les livrables de conception|1.7','tmp/dossier/wireframe-extrait.png|Figure 3 Extrait du wireframe web du devis fourni dans les supports SVG|2.0')
s=s.replace('tmp/dossier/maquette-mobile.png|Figure 4 Maquette mobile du devis en deux parties dans l’ordre de lecture|2.55','tmp/dossier/mobile-extrait.png|Figure 4 Début de la maquette mobile du devis dont la version complète figure en annexe D|2.55')
s=s.replace('public function findByCategorySlug|14','public function findByCategorySlug|12')
s=s.replace('<div class="row row-cols-1|12','<div class="row row-cols-1|5')
s=s.replace('[D4] CNIL, principes de protection des données.','[D4] https://www.cnil.fr/fr/comprendre-le-rgpd/les-six-grands-principes-du-rgpd.')
p.write_text(s,encoding='utf8')
Image.open('tmp/dossier/wireframe-web.png').crop((210,150,1230,510)).save('tmp/dossier/wireframe-extrait.png')
Image.open('tmp/dossier/maquette-mobile.png').crop((0,40,390,430)).save('tmp/dossier/mobile-extrait.png')
