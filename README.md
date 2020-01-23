# BaseConnaissance
## Initialisation du projet
1) Effectuer la commande `git clone git@github.com:nicolas-le-stunff/BaseConnaissance.git ` pour récuperer l'intégralité du projet depuis Github vers votre poste.
2) Sur le terminal et dans le dossier racine du projet, executer la commande `composer install` pour installer les dépendances du projet (composer.json)
3) Copier le fichier `.env` vers la racine du projet et le renommer en `.en.local`. Le fichier en question servira de configuration entre le projet et votre base de donnée.
4) Modifier la ligne `DATABASE_URL=postgresql://{nom}:{motdepasse@{adresse de la bdd}/{nomdelabasededonnée}?serverVersion={versionDuServeur}&charset=utf8`  
5) Le projet est prêt à être utilisé sur symfony
## Règles
### Les branches

`Master` = Branche source du projet  (Ne pas push dessus).

`Dev` = Branche final de developpement (uniquement dédié au merge)

`Dev-{fonctionnalité}-{Prénom}` = Branche de développement personnel.


#### Branche Master
La branche `Master` du projet initial. Le but sera d'avoir des versions (?tags?) du projet a un instant X et stable.

#### Branche Dev
La branche `Dev` est dédiée aux merges de nos differentes branches personnelles. Le but de la branche est de tester le projet et de le rendre stable avant de le pousser vers le master.


####Branche personnelle
`Dev-{fonctionnalité}-{Prénom}`
Branche perso du projet. Vous êtes libres de faire ce que vous voulez dessus. C'est cette branche qui sera merge vers `dev`

### Les pushs

Nos pushs doivent être effectués uniquements sur la branche `Dev-{fonctionalité}-{Prénom}`.
Aucun push (hormis sur le README.MD) ne sera accepté sur les branches : Master / Dev


### Merge

Les merges de `Dev` vers `Master` seront à faire lors de réunion pour figer le projet dans une version stable.
Les merges de `Dev-{Fonctionnalité}-{Prénom}` vers `Dev` auront une pull request avec 2 reviews nécessaires pour être acceptée.

### Conflict 

Dans le cadre du projet, nous aurons probablement des conflicts. Les conflicts sur vos branches perso `Dev-{Fonctionnalité}-{Prénom}` seront à votre charge.
Les conflicts sur le master et sur le dev seront à regler en groupe.


