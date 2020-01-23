# BaseConnaissance
## Initialisation du projet
1) Effectuer la commande `git clone ` pour récuperer l'intégralité du projet depuis Github vers votre poste.
2) Sur le terminal et dans le dossier du projet, executer la commande `composer install` pour installer les dépendances du projet (composer.json)
3) Copier le fichier `.env` vers la racine du projet et le renommer en `.en.local`. Le fichier en question sert de configuration entre le projet et votre base de donnée.
4) Modifier la ligne  
## Règles
### Nos branches

`Master` = Branche source du projet  (Ne pas push dessus).

`Dev` = Branche final de developpement (uniquement dédié au merge)

`Dev-{fonctionnalité}-{Prénom}` = Branche de développement personnel.


## Branche Master
La branche "Master" du projet initial. Le but sera d'avoir des versions (utilisons les tags?)du projet a un instant X et stable.

## Branchen Dev
La branche "Dev" est dédié aux merges de nos differentes branches personnelles. Le but de la branche est de tester le projet et de le rendre stable avant de le pousser vers le master.


## Branche Dev-{fonctionnalité}-{Prénom}
Branche perso du projet. Vous êtes libres de faire ce que vous voulez dessus.

## Les pushs

Nos pushs doivent être effectués uniquements sur la branche "Dev-{fonctionalité}-{Prénom}".
Aucun push ne sera accepté sur les branches : Master / Dev

Ne pas attendre d'avoir "énormement" bosser pour faire des pushs. Pour permettre de reperer rapidement les erreurs et les corrigers.

## Les commits 
Les commits devront avoir des commentaires claire et précis.


## Merge

Les merges de Dev > Master seront à faire lors de réunion pour bloquer le projet à moment fixe.
Les merges de Dev-{Fonctionnalité}-{Prénom} > Dev seront à faire de notre coté.

## Conflict 

Dans le cadre du projet, nous aurons probablement des conflicts. Les conflicts sur vos branches perso (Dev-{Fonctionnalité}-{Prénom}) sera à votre charge.
Les conflicts sur le master et sur le dev sera à regler en groupe si trop compliquer.


