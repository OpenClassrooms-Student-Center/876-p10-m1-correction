# TaskLinker

TaskLinker est une plateforme permettant de gérer les projets de l'entreprise BeWise.

Ce dépôt correspond à la correction de l'exercice du projet 10 du parcours PHP / Symfony. Chaque étape dispose d'une correction dans les branches correction-etape-X.

Le dépôt contient également [la mise en place d'une seconde authentification](https://github.com/OpenClassrooms-Student-Center/876-p10-m1-correction/tree/correction-etape-5) dans le cadre de l'étape facultative. **Google Authenticator** a été mis en place pour cette correction.

## Installation

1. Télécharger le projet
2. Modifier le fichier _.env_ et renseigner vos informations de connexion à la base de données
3. Créer la base de données avec `php bin/console doctrine:database:create`
4. Appliquer les migrations avec `php bin/console doctirne:migrations:migrate`
5. Insérer les fixtures avec `php bin/console doctrine:fixtures:load`
6. Lancer le serveur
