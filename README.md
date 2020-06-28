# AgainstCOVID-19

## Qui sommes nous ?
Nous sommes 3 étudiants ingénieurs de deuxième année en section informatique à CESI Labège : Corentin, Gabriel et Kévin.

## Notre Projet
Le projet AgainstCOVID-19 est notre manière d'ajouter une pierre à l'édifice, d'aider les personnes qui en ont besoin pour traverser la crise actuelle. C'est pourquoi au travers de cette plateforme, les différents services médicaux de l'agglomération toulousaine pourront placer une demande à laquelle nous nous empresseront de répondre, afin que chacun puisse donner son maximum dans la lutte contre le virus.

## Installation
Avant d'utiliser a plateforme, il faut avant tout procéder à certaines installations.

### Prérequis 

* WampServer - Afin d'utiliser localement la plateforme.
* Symfony 5
* PHP 7.4.7
* MySQL 8.0.18

### Déploiement
Pour pouvoir utiliser le site, il faut installer toutes les dépendances asscociées au projet en tapant dans la console : 
```
C:\wamp64\www\AgainstCOVID-19> composer install

```
Puis ensuite lancer les deux commandes suivantes afin de lancer le serveur Symfony et notre API : 
```
C:\wamp64\www\AgainstCOVID-19> php bin/console server:run
```
et
```
C:\wamp64\www\AgainstCOVID-19\API> node server.js
```
