# Projet Web 2025 - Thimeo Ozaneaux

## Calendrier du projet

- **8 avril** - Commencement du projet, mise en place de l'environnement de travail, préparation du Trello, et organisation des tâches.
- **9 avril** - Mise en place du dashboard et du visuel via la base de données (BDD) admin.
- **10 avril** - Finalisation de la Story 1 : dashboard terminé.
- **11 avril** - Travail sur la Story 2, qui sera ensuite abandonnée (création de la page "Vie Commune" et de la table "task"). Apparition d'un bug en début d'après-midi avec XAMPP, MySQL ne fonctionnant plus. Installation de CCleaner pour supprimer des fichiers comme `.vendor`, `.env` et d'autres fichiers du projet.
- **12 avril** - Re-clonage du projet, travail du vendredi supprimé suite à l'abandon de l'ancien projet.
- **14 avril** - Story 3 : création de la table pivot "cohort_user". Affichage des étudiants sur la page "student".
- **15 avril** - Ajout de la fonctionnalité du modal et AJAX complétée.
- **16 avril** - Story 4 : création de la page "cohort". Suite à la Story 3, un problème sur la modification dans la base de données bloque également l'avancée de la Story 4.

## Détails du projet

Le projet consiste en une application web où l'administrateur peut gérer plusieurs aspects des promotions et des utilisateurs. L'application dispose de plusieurs pages accessibles après une authentification.

### Identifiants de l'admin

- **Identifiant** : admin@codingfactory.com
- **Mot de passe** : 12345678

### Identifiants de l'enseignant

- **Identifiant** : teacher@codingfactory.com
- **Mot de passe** : 12345678

### Pages accessibles par l'admin

- **Page Overview** : Affichage des trois premiers éléments :
  - Promotions
  - Élèves
  - Enseignants
  - Groupes (en dur)
  
- **Page Promotions** : Affichage des promotions et du nombre d'élèves associés à chaque promotion.

- **Page Étudiants** : Affichage de tous les étudiants et accès à un modal pour modifier leurs informations.

- **Page Enseignants** : Affichage de tous les enseignants et accès à un modal pour modifier leurs informations.

### Fonctionnalités de l'enseignant

Dans son tableau de bord, l'enseignant peut voir les informations suivantes :

- Les élèves qui font partie de ses promotions.
- Les promotions auxquelles il appartient.
- Les autres enseignants avec lesquels il travaille.

## Problèmes rencontrés

1. **Bug XAMPP** : MySQL ne fonctionnait plus pendant un jour et demi, bloquant le développement.
2. **Problème d'insertion des données dans la base de données** : Difficulté à comprendre l'insertion correcte des données dans la BDD, ce qui a retardé certaines étapes du projet.

## Suivi des Stories

- **Story 1** : Terminé
- **Story 2** : Terminé (Ajout de la fonctionnalité pour l'enseignant de voir les élèves, promotions et enseignants associés à lui)
- **Story 3** : Affichage de la page (récupération des étudiants) + affichage du modal avec les étudiants (AJAX) : Terminé
- **Story 4** : Affichage de la page "cohort" : Terminé
- **Story 5** : Pas fait
- **Story 6** : Pas fait
