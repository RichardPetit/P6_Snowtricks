#Prérequis

Ce projet necessite l'environnement suivant:

PHP >= 7.4

Symfony >= 5.3

MySQL >= 5.6

Composer

#Installation

Cloner le repository Github:
https://github.com/RichardPetit/P6_Snowtricks


#Bibliothèques externe

Afin d'installer les librairies du projet, vous devez lancer la commande suivante:
composer install

#Variables d'environnement

Afin de déclarer vos variables d'environnement (configuration base de données et email) vous devez copier le fichier 
.env.example vers un fichier .env à la racine du projet. Vous devez personaliser ce fichier .env avec vos propres valeurs.

#Base de données

Créez la base de données avec la commande ci-dessous:

    php bin/console doctrine:database:create

Puis mettez à jour la structure de la base de données avec la commande:

    php bin/console doctrine:migrations:migrate


#Implementez les fixtures :
Créez vos données en chargeant les fixtures avec la commande:

    php bin/console doctrine:fixtures:load

#Envoi d'email

Vous devez configurer les valeurs SMTP dans le fichier .env afin de configurer l'envoi d'email.


#Contexte

Jimmy Sweat est un entrepreneur ambitieux passionné de snowboard. Son objectif est la création d'un site collaboratif 
pour faire connaître ce sport auprès du grand public et aider à l'apprentissage des figures (tricks).

Il souhaite capitaliser sur du contenu apporté par les internautes afin de développer un contenu riche et suscitant 
l’intérêt des utilisateurs du site. Par la suite, Jimmy souhaite développer un business de mise en relation avec les 
marques de snowboard grâce au trafic que le contenu aura généré.

Pour ce projet, nous allons nous concentrer sur la création technique du site pour Jimmy.

#Description du besoin

Vous êtes chargé de développer le site répondant aux besoins de Jimmy. Vous devez ainsi implémenter les fonctionnalités suivantes :

    un annuaire des figures de snowboard. Vous pouvez vous inspirer de la liste des figures sur Wikipédia. Contentez-vous d'intégrer 10 figures, le reste sera saisi par les internautes ;
    la gestion des figures (création, modification, consultation) ;
    un espace de discussion commun à toutes les figures.

Pour implémenter ces fonctionnalités, vous devez créer les pages suivantes :

    la page d’accueil où figurera la liste des figures ; 
    la page de création d'une nouvelle figure ;
    la page de modification d'une figure ;
    la page de présentation d’une figure (contenant l’espace de discussion commun autour d’une figure).
