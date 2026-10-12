from pathlib import Path
from PIL import Image,ImageDraw,ImageFont
import pypdfium2 as pdfium
r=Path.cwd(); o=r/'tmp/dossier'
for name,pages in [('EDUCENTRE_RNCP31114_REAC.pdf',[1,8]),('Corentin_Polard_Dossier_Projet.pdf',[5,12])]:
 d=pdfium.PdfDocument(str(r/'output/Exemplo'/name))
 for n in pages:d[n].render(scale=1).to_pil().save(o/(name[:8]+str(n)+'.png'))
font='C:/Windows/Fonts/arial.ttf'; bold='C:/Windows/Fonts/arialbd.ttf'
def diagram(name,boxes,edges,size=(1500,850)):
 im=Image.new('RGB',size,'white');dr=ImageDraw.Draw(im)
 for a,b,label in edges:
  x,y=boxes[a][:2];xx,yy=boxes[b][:2]; x+=180;y+=75;xx+=180;yy+=75
  dr.line((x,y,xx,yy), fill='#85724e',width=4)
  if label:dr.text(((x+xx)/2,(y+yy)/2-23),label,font=ImageFont.truetype(font,18),fill='#222222',stroke_width=3,stroke_fill='white',anchor='mm')
 for x,y,title,body in boxes:
  dr.rounded_rectangle((x,y,x+360,y+150),radius=8,fill='#f7f4ee',outline='#8c7956',width=3)
  dr.text((x+16,y+16),title,font=ImageFont.truetype(bold,27),fill='#222222')
  for i,line in enumerate(body.split('\n')):dr.text((x+16,y+56+i*28),line,font=ImageFont.truetype(font,23),fill='#333333')
 im.save(o/(name+'.png'))
diagram('architecture',[(40,90,'Navigateur','HTML et CSS\nJavaScript'),(560,90,'Symfony','Routes et contrôleurs\nFormulaires et sécurité'),(1080,90,'Twig','Layouts et vues\nRendu HTML'),(560,430,'Doctrine','Entités et repositories\nParamètres de requête'),(1080,430,'MariaDB','Tables et relations\nContraintes SQL'),(40,430,'Fichiers','Images publiques\nLogos de devis')],[(0,1,'HTTP'),(1,2,'rendu'),(1,3,'données'),(3,4,'SQL'),(1,5,'upload')],(1500,640))
diagram('mcd',[(50,50,'Utilisateur','id, email, rôles\nnom, prénom'),(550,50,'Avis','id, contenu, note\nstatut, date'),(1050,50,'Produit','id, titre, prix indicatif\nactif, image, slug'),(50,430,'Demande de devis','id, coordonnées, quantité\nmarquage, statut, logo'),(1050,430,'Catégorie','id, nom, description\nimage, slug')],[(0,1,'0,N / 1,1'),(0,3,'0,N / 0,1'),(1,2,'0,1 / 0,N'),(2,4,'0,N / 0,N')],(1500,650))
diagram('navigation',[(30,60,'Accueil','Présentation de l’atelier\nAccès aux prestations'),(550,60,'Prestations et galerie','Catégories et produits\nFiches détaillées'),(1050,60,'Demande de devis','Coordonnées et projet\nConfirmation après envoi'),(30,410,'Connexion','Inscription et session\nRôle utilisateur'),(550,410,'Avis','Note et commentaire\nModération avant publication'),(1050,410,'Administration','Catalogue, avis, devis\nAccès ROLE_ADMIN')],[(0,1,'consulter'),(1,2,'demander'),(0,3,'se connecter'),(3,4,'déposer'),(3,5,'si admin')],(1500,630))
diagram('quote-flow',[(25,40,'1 Formulaire','Champs métier et fichier\nJeton CSRF'),(555,40,'2 Validation','handleRequest\nisSubmitted et isValid'),(1085,40,'3 Traitement','Nom composé et logo\nStatut new et date'),(1085,400,'4 Persistance','persist puis flush\nInsertion SQL'),(555,400,'5 Confirmation','Message flash\nRedirection accueil'),(25,400,'6 Administration','Lecture de la demande\nprocessing puis finished')],[(0,1,''),(1,2,''),(2,3,''),(3,4,''),(4,5,'')],(1500,610))
# Crop existing mobile design to its first two panels, preserving original content.
p=r/'output/design/nouveaux-svg/verification/mobile-demande-de-devis.png'
im=Image.open(p);im.crop((0,0,780,im.height)).save(o/'maquette-mobile.png')


