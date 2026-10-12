# Cahier des charges - Projet de Site de Broderie

## 1. Contexte et Objectif
Le projet consiste à créer un site web vitrine et interactif pour une artisane brodeuse.
Le site n'a pas vocation à faire de la vente en ligne directe (e-commerce), mais à présenter des idées de produits, valoriser le savoir-faire et permettre aux utilisateurs de demander des devis personnalisés ou de laisser des avis.

## 2. Rôles et Utilisateurs
- **Visiteur / Utilisateur non connecté :** Peut consulter le catalogue, filtrer par catégorie, voir les avis validés, et envoyer une demande de devis.
- **Utilisateur connecté (`ROLE_USER`) :** Peut en plus laisser des avis (commentaires et notes) sur les produits ou le site.
- **Administrateur (`ROLE_ADMIN`) :** Possède un accès Back-Office complet pour :
    - Gérer les catégories et les produits (CRUD avec images).
    - Modérer les avis (valider ou rejeter avant affichage public).
    - Consulter et suivre les demandes de devis.

## 3. Définition du MVP (Minimum Viable Product)
Pour l'examen de qualification, le MVP comprendra :
1. **Catalogue & Filtres :** Affichage des produits classés par catégories.
2. **Système d'Authentification :** Inscription, connexion et gestion des rôles (User / Admin via Symfony Security).
3. **Interactivité & Avis :** Dépôt d'avis par les utilisateurs connectés et panneau de modération administrateur.
4. **Formulaire de Devis :** Enregistrement des demandes de contact/devis en base de données.
5. **Internationalisation (i18n) :** Site disponible en Français (interface) et Anglais.
