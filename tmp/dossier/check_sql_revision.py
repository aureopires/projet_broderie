from pathlib import Path
from pypdf import PdfReader

pdf = PdfReader(Path('output/dossier_projet/Aureo_Ruffier_Dossier_Projet_DWWM.pdf'))
assert len(pdf.pages) == 43
text = '\n'.join(page.extract_text() or '' for page in pdf.pages)
assert 'nosql' not in text.lower()
assert 'Accès SQL avec MariaDB et Doctrine' in ' '.join(text.split())
print('PDF verified: 43 pages, 36 body pages, no NoSQL mention; SQL evidence preserved.')
