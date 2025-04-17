## 📅 Calendrier du projet

- **8 avril** - Commencement du projet, mise en place de l'environnement de travail, préparation du Trello, et organisation des tâches.
- **9 avril** - Mise en place du dashboard et du visuel via la base de données (BDD) admin.
- **10 avril** - Finalisation de la Story 1 : dashboard terminé.
- **11 avril** - Travail sur la Story 2, qui sera ensuite abandonnée (création de la page "Vie Commune" et de la table "task"). Apparition d'un bug en début d'après-midi avec XAMPP, MySQL ne fonctionnant plus. Installation de CCleaner pour supprimer des fichiers comme `.vendor`, `.env` et d'autres fichiers du projet.
- **12 avril** - Re-clonage du projet, travail du vendredi supprimé suite à l'abandon de l'ancien projet.
- **14 avril** - Story 3 : création de la table pivot "cohort_user". Affichage des étudiants sur la page "student".
- **15 avril** - Ajout de la fonctionnalité du modal et AJAX complétée.
- **16 avril** - Story 4 : création de la page "cohort". Suite à la Story 3, un problème sur la modification dans la base de données bloque également l'avancée de la Story 4.

## 📑 Détails du projet

Le projet consiste en une application web où l'administrateur peut gérer plusieurs aspects des promotions et des utilisateurs. L'application dispose de plusieurs pages accessibles après une authentification.

### Identifiants de l'admin
- **Identifiant** : `admin@codingfactory.com`
- **Mot de passe** : `12345678`

### Identifiants de l'enseignant
- **Identifiant** : `teacher@codingfactory.com`
- **Mot de passe** : `12345678`

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

---

## 📋 Suivi des Stories

### **Story 1** : Tableau de bord Admin ✅
- **Statut** : Terminé
- **Description** : Création du tableau de bord pour l'administrateur avec les informations sur les promotions, élèves, enseignants et groupes.

### **Story 2** : Tableau de bord Enseignant ✅
- **Statut** : Terminé
- **Description** : Ajout de la fonctionnalité pour l'enseignant de voir les élèves, promotions et enseignants associés à lui via un tableau de bord personnalisé.
  - Fonctionnalités complètes mais sans AJAX.

### **Story 3** : Gestion des étudiants ⚠️
- **Statut** : Terminé
- **Description** : 
  - Création de la page "students" pour afficher les étudiants.
  - Mise en place d'un modal avec les informations des étudiants.
  - Problèmes rencontrés :
    - Impossible de créer le formulaire pour ajouter un étudiant.
    - Bien que le modal se remplisse correctement avec les informations, il n'est pas possible de modifier et enregistrer les données dans la base de données.
    - Il n'est pas possible de supprimer un étudiant de la base de données.
    - L'ajout d'un étudiant à une promotion ne fonctionne pas correctement.
    - Pas de gestion du changement de mot de passe des étudiants.

### **Story 4** : Gestion des cohortes ⚠️
- **Statut** : Terminé
- **Description** : 
  - Création de la page "cohort" pour afficher les cohortes.
  - Possibilité de supprimer une cohorte ainsi que de supprimer des étudiants et des professeurs de la cohorte.
  - Problèmes rencontrés :
    - L'édition des informations des cohortes n'a pas été réalisée.
    - L'implémentation d'AJAX pour la mise à jour dynamique n'a pas été réussie.

### **Story 5** : Gestion des enseignants ⚠️
- **Statut** : Terminé
- **Description** : 
  - Création de la page "enseignant" pour gérer les enseignants.
  - Possibilité de créer et supprimer un enseignant.
  - Problèmes rencontrés :
    - L'édition des enseignants n'a pas été implémentée.
    - Pas d'AJAX pour gérer dynamiquement les enseignants.

### **Story 6** : Gestion des mots de passe ⏳
- **Statut** : Non réalisé
- **Description** : 
  - Fonctionnalité permettant aux utilisateurs (étudiants et enseignants) de modifier leur mot de passe depuis leur profil.
  - Aucune action n’a été réalisée pour cette fonctionnalité.

---

🎯 **Prochaines étapes** :
- Terminer l'implémentation de l'AJAX.
- Résoudre les problèmes de modification des informations dans la base de données.
- Implémenter la gestion du mot de passe.
