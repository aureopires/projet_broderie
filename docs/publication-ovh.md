# Publication des corrections sur OVH

Procédure préparée le 12 octobre 2026 à partir du projet local. L’hébergement déclaré est OVH, avec transfert par FileZilla. L’offre exacte, le dossier racine du domaine, la version PHP du serveur et la disponibilité de SSH restent à relever dans le panneau OVH. Aucune modification du serveur public n’a été effectuée.

## État des courriels

La boîte e-mail du domaine n’est pas encore créée. `APP_EMAIL_ENABLED=0` est donc la valeur par défaut. Le formulaire de contact reste visible normalement ; une tentative d’envoi valide affiche ensuite une information d’indisponibilité, sans effacer les champs remplis. Les inscriptions restent possibles, sans annoncer l’envoi d’un courriel. Les demandes de devis restent disponibles : elles sont enregistrées dans la base et ne dépendent pas du transport SMTP.

Le code de confirmation est préparé avec un lien signé et une page de renvoi protégée par CSRF, limitée à trois demandes par compte et par heure. Son fonctionnement applicatif a été vérifié avec un transport simulé, sans envoyer de courriel réel. La connexion existante reste disponible aux comptes non vérifiés ; `isVerified` représente uniquement l’état de confirmation de l’adresse.

Créer la boîte `contact@laiguilledesvolcans.fr`, puis relever dans OVH les paramètres SMTP correspondant à l’offre réellement souscrite. Roundcube est une interface de webmail ; le site utilise le transport SMTP. La documentation MX Plan décrit plusieurs interfaces et les paramètres SMTP : [Documentation officielle OVH MX Plan](https://docs.ovhcloud.com/en/guides/web-cloud/email-and-collaborative-solutions/mx-plan/landing-page-mx-plan).

Renseigner `MAILER_DSN` dans la configuration privée de production. Ne pas enregistrer les identifiants dans Git ni les communiquer dans le dossier du projet. Tester l’envoi, la réception, le lien de confirmation et la réponse au contact avec une adresse de recette convenue. Activer ensuite `APP_EMAIL_ENABLED=1` dans cette configuration et renouveler le cache de production. Ne pas activer avec un transport `null://` ou un transport simulé.

## Préparation de la livraison

1. Identifier la version à livrer et sauvegarder la base, les images publiques et les anciens logos. Conserver la sauvegarde hors de la racine publique.
2. Vérifier que la racine web du domaine pointe sur le dossier `public` du projet. Les dossiers `src`, `config`, `vendor`, `private`, `docs`, `output` et les fichiers d’environnement doivent rester hors de la racine servie.
3. Préparer une copie de livraison distincte du poste de développement. Installer les dépendances depuis `composer.lock` avec `composer install --no-dev --optimize-autoloader`. Le composant `symfony/rate-limiter` et le nouveau fichier de configuration doivent être inclus.
4. Compiler les ressources avec `npm ci` puis `npm run build` dans cette copie. Transférer l’ensemble de `public/build`, y compris `entrypoints.json`, `manifest.json` et les fichiers portant une empreinte dans leur nom.
5. Garder `APP_ENV=prod`, `APP_DEBUG=0` et `SITE_MAINTENANCE=1` pendant la livraison. Préserver les paramètres privés de production. Ne pas remplacer le fichier privé de production par les valeurs locales.
6. Transférer le code et les dépendances avec FileZilla, de préférence avec le protocole chiffré disponible dans l’offre. Ne pas transférer `.git`, `node_modules`, `tests`, les caches de développement, `tmp` ou les dossiers de travail du dossier de projet.

Si SSH est disponible, les commandes Symfony s’exécutent depuis le dossier du projet avec le binaire PHP compatible de l’hébergement. [Documentation officielle OVH sur SSH](https://docs.ovhcloud.com/en/guides/web-cloud/web-hosting/ssh-on-webhosting). Sans SSH, prévoir la préparation locale des dépendances et un moyen d’administration fourni par l’hébergement ; ne pas exposer un script de console PHP dans une URL publique.

## Stockage des logos de devis

Les nouveaux logos sont enregistrés dans `private/quote-logos`, hors de `public` et de `var` pour éviter de les perdre lors du nettoyage du cache. Ce dossier doit être conservé entre les livraisons et inclus dans les sauvegardes. Le processus PHP doit pouvoir le lire et y écrire ; les fichiers ne doivent pas être lisibles par le serveur statique.

Les données de devis utilisées pendant le développement étant fictives, aucune migration automatique des anciens logos n’est prévue. Avant la mise en ligne, si `public/uploads/quote-logos` contient des fichiers correspondant à des devis à conserver, sauvegarder ces fichiers, les transférer manuellement vers `private/quote-logos` sans changer leurs noms, vérifier leur téléchargement depuis un compte administrateur, puis retirer les exemplaires publics après validation de la copie. Vérifier que les anciennes URL publiques ne livrent plus les fichiers. Les anciens SVG ou GIF ne sont pas proposés au téléchargement : les convertir en PNG, JPEG ou WebP avant de les remplacer dans l’administration.

## Vérifications avant ouverture publique

- Vérifier l’installation des dépendances et renouveler le cache de production. Ne pas transmettre le cache généré sur le poste de développement.
- Vérifier la connexion, le refus des accès administratifs sans les droits nécessaires et le téléchargement d’un logo par un administrateur.
- Envoyer un devis fictif, le retrouver dans l’administration et tester une substitution de logo. Vérifier les refus des données invalides et des formats non autorisés.
- Vérifier les deux routes de catégorie, l’absence des produits désactivés et le message d’une catégorie sans produits actifs.
- Vérifier une inscription, la conservation du mot de passe lors d’une modification administrative sans nouvelle saisie et la limitation des tentatives de connexion.
- Quand le SMTP est prêt, vérifier les courriels réels et les liens signés sur le domaine public. Ne pas déduire la délivrabilité du résultat des tests simulés.
- Vérifier le menu et les formulaires sur un téléphone réel, ainsi que la navigation au clavier. Les contrôles locaux de rendu ne constituent pas un audit RGAA complet.
- Conserver la version, la date et les résultats de la recette. Retirer la maintenance après validation.

La configuration Docker reste un environnement local de développement. Ne pas la présenter comme la configuration de l’hébergement OVH. Les cibles de réinitialisation de base du Makefile ne doivent pas servir à publier cette version. Les corrections décrites ici ne changent pas le schéma SQL.
