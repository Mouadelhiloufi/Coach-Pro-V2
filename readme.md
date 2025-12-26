#  COACH_PRO — Plateforme Sportifs & Coachs

##  Présentation du projet

**COACH_PRO** est une plateforme web développée en **PHP orienté objet** permettant de mettre en relation des **sportifs** avec des **coachs sportifs professionnels**.

Cette première version (MVP) a pour objectif de valider le concept avant une future évolution plus avancée (paiement, messagerie, planning intelligent, etc.).

---

##  Objectifs du projet

- Mettre en pratique la **programmation orientée objet en PHP**
- Gérer des utilisateurs avec des rôles différents (Coach / Sportif)
- Implémenter un système simple de **séances** et de **réservations**
- Utiliser **PDO** pour l’accès sécurisé à la base de données
- Structurer un projet PHP de manière claire et maintenable

---

##  Fonctionnalités principales

###  Authentification
- Inscription des utilisateurs
- Connexion / Déconnexion
- Gestion de session

###  Coach
- Accès à une page dédiée (`coach_page.php`)
- Consultation et modification de son profil (`profile_coach.php`)
- Création de séances
- Consultation des séances réservées

###  Sportif
- Accès à une page dédiée (`athlete_page.php`)
- Consultation des séances disponibles
- Réservation d’une séance (`athlete_reservation.php`)
- Consultation de ses réservations

###  Séances
- Ajout de séances par le coach
- Statut automatique :
  - `disponible`
  - `réservée`
- Une séance réservée devient indisponible

---

##  Structure du projet

COACH_PRO/
│
├── pages/
│   ├── athlete_page.php          
│   ├── athlete_reservation.php   
│   ├── coach_page.php             
│   ├── profile_coach.php         
│   ├── login.php
│   ├── logout.php                
│   └── signUp.php               
│
├── sources/
│   ├── components/               
│   ├── db/
│   │   └── db.php                
│   └── outils/                   
│
├── index.php                    
├── readme.md                     



---

##  Architecture & POO

### Principes appliqués :

- **Encapsulation**
  - Propriétés privées / protégées
  - Accès via getters et setters

- **Constructeurs**
  - Initialisation propre des objets

- **Héritage**
  - Classe de base `Utilisateur`
  - Classes dérivées :
    - `Coach`
    - `Sportif`

- **Séparation des responsabilités**
  - Pages : affichage et interaction utilisateur
  - Sources : logique métier et accès aux données

---

##  Base de données

Connexion à la base via **PDO** (`sources/db/db.php`)

### Tables principales :
- `users`
- `coachs`
- `sportifs`
- `seances`
- `reservations`

Relations :
- Un coach possède plusieurs séances
- Un sportif peut réserver plusieurs séances
- Une séance ne peut être réservée qu’une seule fois

---

##  Sécurité & bonnes pratiques

- Requêtes préparées (PDO)
- Validation des formulaires côté serveur
- Gestion de session
- Restrictions d’accès selon le rôle utilisateur
- Code commenté et lisible

---

##  Évolutions possibles

- Planning interactif
- Paiement en ligne
- Notation des coachs
- Messagerie interne
- Notifications
- API REST

---

##  Technologies utilisées

- PHP 8+
- MySQL
- PDO
- HTML5 / CSS3
- (Optionnel) Tailwind CSS / Bootstrap

---

##  Statut du projet

 **Version 1 – MVP fonctionnel**

---

##  Auteur

Projet réalisé dans un cadre pédagogique pour l’apprentissage de :
- PHP orienté objet
- MySQL
- Architecture web simple

