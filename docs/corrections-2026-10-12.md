# Corrections du projet L’Aiguille des Volcans

État local au 12 octobre 2026. Ce document conserve les modifications et les preuves à intégrer lors de la prochaine révision du dossier de projet. Les tests fonctionnels utilisent une base SQLite en mémoire et des courriels simulés. La base MariaDB de développement n’a pas été réinitialisée.

## Validation des devis et catégories

Le formulaire public vérifie désormais côté serveur la présence des champs obligatoires et le format de l’adresse e-mail. La quantité doit être renseignée et être au moins égale à un. Les deux routes de catégorie utilisent le même template et la requête de produits actifs du repository. Les types PHP et la nullabilité SQL des entités sont conservés.

## Logos privés

Les formulaires public et administratif partagent `QuoteLogoType` : PNG, JPEG et WebP, jusqu’à 15 Mo, avec vérification de l’extension et du type de contenu. `QuoteLogoStorage` vérifie également le contenu raster avant le stockage, génère le nom, utilise le dossier privé et limite les permissions des fichiers. SVG et GIF ne sont plus acceptés pour les nouveaux logos.

Le téléchargement passe par `admin_quote_request_logo`, protégé par `ROLE_ADMIN`, avec une réponse en pièce jointe, `no-store` et `nosniff`. Les noms de fichier ne proviennent pas d’un chemin fourni dans l’URL. Les traversées de répertoire et les liens symboliques sont refusés. Les anciens SVG ne sont pas proposés au téléchargement.

Un échec de stockage affiche une erreur sur le formulaire. Un échec de sauvegarde SQL déclenche la suppression du nouveau fichier. Lors d’un remplacement, l’ancien fichier n’est supprimé qu’après la sauvegarde du nouveau nom en base. Lors d’une suppression de devis, le logo est supprimé après le succès de la suppression SQL ; les erreurs de suppression de fichier sont journalisées.

Le seul ancien logo présent localement a été déplacé de `public/uploads/quote-logos` vers `private/quote-logos`. Son nom et son contenu ont été conservés, avec comparaison des empreintes SHA-256 avant et après. Ce déplacement ne concerne pas le serveur OVH.

## Mobile et clavier

Les layouts déclarent `lang="fr"` et le viewport. Les boutons du menu ont un nom accessible et les attributs de contrôle de l’ouverture. Le menu public indique la page courante. Un lien d’accès au contenu et un focus visible sont ajoutés. La fenêtre d’agrandissement rend le focus au bouton d’origine après fermeture. Les boutons dorés, les liens actifs et le mode de mouvement réduit ont reçu des ajustements. Les tableaux de devis disposent d’un conteneur de défilement.

Les marges des lignes Bootstrap du contact et de la fiche produit ont été corrigées après observation d’un débordement à 320 pixels. La marge du bouton d’envoi du devis a été corrigée après observation d’un débordement à 768 pixels.

Ces contrôles ciblés ne constituent pas un audit RGAA complet ni une recette sur téléphone physique.

## Contact et comptes

Le contact utilise maintenant un formulaire Symfony avec validation serveur et CSRF. Le message utilise le domaine de l’atelier comme expéditeur et l’adresse du visiteur comme `Reply-To`. Les erreurs de transport sont journalisées. Le message d’erreur est présenté sans annoncer un envoi réussi.

Le formulaire administratif utilise un champ `plainPassword` non mappé, vide et masqué. Une modification sans nouvelle saisie conserve le hachage actuel. La création exige un mot de passe. Les nouvelles saisies de mot de passe exigent au moins douze caractères. Les tentatives de connexion sont limitées avec le composant Symfony Rate Limiter.

La confirmation de compte est préparée : lien signé associé à l’identifiant, ouverture sans session préalable, contrôle de signature avant mise à jour et renvoi protégé par CSRF, limité à trois demandes par heure et par compte. La boîte e-mail OVH n’étant pas créée, `APP_EMAIL_ENABLED=0` désactive actuellement le contact par courriel et l’envoi de confirmation. À la demande du candidat, le formulaire de contact reste visible normalement : le message d’indisponibilité apparaît seulement après une tentative d’envoi valide, en conservant les champs remplis. Les inscriptions restent possibles. Le devis continue à être enregistré normalement. Les comptes non confirmés conservent l’accès existant ; aucune restriction générale supplémentaire n’est appliquée au login.

## Contrôles exécutés

- PHPUnit : 63 tests réussis, 224 assertions, sans avertissement ni dépréciation.
- Syntaxe Twig : 52 fichiers valides.
- Syntaxe YAML : 27 fichiers valides.
- Injection des services : configuration valide.
- Doctrine : mappage correct et base MariaDB locale synchronisée avec les entités.
- Compilation des ressources en mode production : réussie.

Les tests couvrent les données de devis valides et invalides, les deux routes de catégorie, les filtres du repository, les images autorisées et refusées, les limites de taille, l’accès aux logos selon les droits, le remplacement et la suppression du logo, la migration des anciens fichiers, la protection CSRF du contact, les courriels simulés, la conservation du mot de passe, les liens signés, l’inscription et la modération des avis.

La vérification du navigateur rend les pages locales de devis, contact, galerie et fiche produit avec les ressources locales. Elle examine les largeurs de 320, 390, 768 et 1366 pixels, le viewport, l’absence de débordement horizontal, le menu mobile et l’ouverture et fermeture de l’image par clavier. Les ressources externes sont bloquées pendant ce contrôle. Le mode de contact vérifié visuellement correspond au courriel désactivé ; les tests fonctionnels exercent aussi le formulaire activé avec un transport simulé.

## Points à compléter

La livraison OVH et la recette de production suivent [la procédure préparée](publication-ovh.md). Il reste à créer la boîte e-mail, configurer le transport réel et vérifier la réception des messages. La version PHP, le dossier racine et les possibilités d’accès console de l’offre OVH restent à confirmer. Les nouveaux fichiers privés doivent être inclus dans les sauvegardes.

L’accès NoSQL n’est pas ajouté par ces corrections. Sa démonstration dans le parcours d’évaluation doit être confirmée avec le centre. Les preuves historiques de validation des maquettes et de veille doivent provenir du candidat ; les corrections techniques ne les remplacent pas.
