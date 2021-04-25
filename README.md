## Index
1. Infos générales
2. Fonctionnalités
3. Installation
4. Prérequis
___
## 1) Infos générales
- Nom du projet : Free_ads
- Statut du projet : Fini
    - Version : 1.0
- Auteur: Christopher Debray  ( linkedin : https://www.linkedin.com/in/christopher-debray/ )
- Objectif (résumé du sujet) :
    - Le but du projet est de créer site d'annonce sous Laravel 8
- Compétences apprises :
    - Laravel 8
    - Bootstrap
___
## 2) Fonctionnalités
##### Si non connecté :
- Formulaire d'inscription ( avec mail de vérification )
    - Nom
    - Email
    - Mot de passe
- Formulaire de connexion
    - Email
    - Mot de passe
___
##### Si connecté : 
- Modification du compte :
    - Email
    - Mot de passe
    - Suppression du compte
- Création d'annonces :
    - Titre
    - Description
    - Localisation
    - Prix
    - Image
- Listing des annonces selon leurs ordre de création
- Formulaire de recherche d'annonce :
    - Par nom
    - Par localisation
    - Par prix
- Système de messagerie :
    - Envoi et réception des messages
    - Suppression de message envoyé
___
## 3) Installation
Suivez bien les étapes ci-dessous !
###  Étape 1 : installation des dépendances
- Déplacez vous dans votre dossier et lancez les commande :
    - composer install
    - npm install
    - php artisan key:generate
###  Étape 2 : création de la base de données
- Créer une base de données du nom de free_ads
###  Étape 3 : configuration du fichier .env
- cp .env.example .env  ( créer un fichier .env à partir du template, il faudra ensuite modifier le fichier .env sans toucher au .env.example)
- Modifier la partie de votre fichier .env ( à la racine du dossier cloné ), d'abord la partie contenant :
<pre>
    <code>
        DB_CONNECTION=mysql
        DB_HOST=127.0.0.1
        DB_PORT=3306
        DB_DATABASE=laravel
        DB_USERNAME=root
        DB_PASSWORD=
    </code>
</pre>
- Remplacez les valeurs suivantes : 
    - DB_PORT  par le port qu'utilise votre localhost
    - DB_DATABASE  par le nom de la base de données, qui sera ***free_ads***
    - DB_USERNAME  par le nom d'utilisateur que vous utilisez pour accéder à votre phpMyAdmin
    - DB_USERNAME  par le mot de passe que vous utilisez pour accéder à votre phpMyAdmin
###  Étape 4 : insertion des tables dans la base de données
- Utiliser sur le terminal ( dans le dossier cloné ) la commande :
    - php artisan migrate
###  Étape 5 : vérification de mail, mailtrap
***Important ! Obligatoire afin de pouvoir utiliser le projet !***
- Se rendre sur le site https://mailtrap.io/signin ( Mailtrap )
***Mailtrap est un outil qui permet l'envoi d'email, ici cela nous sers pour tester / utiliser la vérfication d'email***
- Une fois connecté, se rendre dans l'onglet inbox et cliquez sur le lien My Inbox.
- Dans l'onglet **SMTP Settings** de My Inbox :
    - Sélectionnez le menu déroulant sous **Integrations** 
        - Dans ce menu dans la catégorie PHP sélectionnez Laravel 7+
- En dessous du menu déroulant vous devriez trouvez un block de code ressemblant au suivant :
<pre>
    <code>
        MAIL_MAILER=smtp
        MAIL_HOST=smtp.mailtrap.io
        MAIL_PORT=2525
        MAIL_USERNAME=90b8de4034c5e4
        MAIL_PASSWORD=f9c7eb8e9dad1e
        MAIL_ENCRYPTION=tls
    </code>
</pre>
- Récupérez le code et modifier le code de votre fichier .env en conséquence
- Vous devez aussi modifier la ligne : MAIL_FROM_ADDRESS=
    - En valeur mettez une adresse email valide
***Lors de l'envoi d'un email de vérification, il faudra vérifier dans My Inbox puis confirmer le mail***
___
## 4) Prérequis
- PHP 
- MySQL
___
## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
