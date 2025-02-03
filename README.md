
# Technipole Sup Valor - Site Web

Un site web moderne et interactif pour promouvoir les startups, actualités et activités du Technipole Sup Valor. Ce projet inclut une interface publique et un panneau d'administration pour gérer les contenus dynamiques tels que les actualités, startups, et partenaires.

---

## 📋 Fonctionnalités Principales

- **Interface publique :**
  - Slider d'actualités.
  - Liste interactive des startups avec fiches détaillées.
  - Pages dynamiques pour actualités, startups, partenaires et contact.
- **Interface d'administration :**
  - Gestion des actualités (ajout, modification, suppression).
  - Gestion des startups (ajout, modification, suppression).
  - Gestion des partenaires et sponsors.
- **Responsive Design** compatible avec les mobiles, tablettes et ordinateurs.

---

## 🚀 Déploiement en Local

Suivez les étapes ci-dessous pour déployer le projet en local sur votre machine.

### 1. Prérequis

- **Serveur Web** : [XAMPP](https://www.apachefriends.org/index.html) ou [WAMP](https://www.wampserver.com/).
- **PHP** : Version 7.4 ou supérieure.
- **MySQL** : Version 5.7 ou supérieure.
- **Navigateur Web** : Chrome, Firefox ou Edge.
- **Éditeur de texte** : [VS Code](https://code.visualstudio.com/) ou tout autre éditeur de code.

---

### 2. Cloner le Projet

Téléchargez ou clonez le dépôt Git sur votre machine locale :

```bash
git clone https://github.com/TOGETTEC-INC/technipole-sup-valor.git
cd technipole-sup-valor
```

---

### 3. Configuration de l'Environnement

#### 3.1. Déplacer les fichiers
1. Placez tous les fichiers dans le dossier `htdocs` de votre serveur local (par exemple `C:/xampp/htdocs/technipole-sup-valor` pour XAMPP).

#### 3.2. Créer la base de données
1. Lancez votre serveur MySQL à partir de XAMPP ou WAMP.
2. Accédez à **phpMyAdmin** via votre navigateur à l'adresse : [http://localhost/phpmyadmin](http://localhost/phpmyadmin).
3. Créez une nouvelle base de données nommée `technipole_db`.
4. Importez le fichier SQL de structure et de données :
   - Rendez-vous dans l'onglet **Importer**.
   - Sélectionnez le fichier `database.sql` présent dans le répertoire du projet.
   - Cliquez sur **Exécuter**.

#### 3.3. Configuration de la connexion à la base de données
1. Ouvrez le fichier `config/database.php`.
2. Modifiez les informations de connexion à votre base de données si nécessaire :
   ```php
   $host = 'localhost';
   $dbname = 'technipole_db';
   $username = 'root'; // Par défaut pour XAMPP/WAMP
   $password = '';     // Par défaut vide pour XAMPP/WAMP
   ```
3. Enregistrez les modifications.

---

### 4. Lancer le Projet

1. Assurez-vous que votre serveur Apache et MySQL sont démarrés via XAMPP/WAMP.
2. Accédez au site via votre navigateur à l'adresse :  
   [http://localhost/technipole-sup-valor](http://localhost/technipole-sup-valor).

---

### 5. Fonctionnalités de l'Administration

1. Accédez à l'interface d'administration via :  
   [http://localhost/technipole-sup-valor/admin/login.php](http://localhost/technipole-sup-valor/admin/login.php).
2. Connectez-vous avec les identifiants par défaut :
   - **Nom d'utilisateur** : `admin`
   - **Mot de passe** : `admin` (à modifier après la première connexion).

---

## 📂 Structure des Fichiers

```plaintext
technipole-sup-valor/
├── admin/
│   ├── login.php        # Page de connexion administrateur
│   ├── manage_news.php  # Gestion des actualités
│   ├── manage_startups.php  # Gestion des startups
│   └── components/      # Navbar, sidebar, etc.
├── assets/
│   ├── css/             # Fichiers CSS
│   ├── images/          # Images statiques
│   ├── js/              # Scripts JavaScript
├── config/
│   └── database.php     # Configuration de la base de données
├── uploads/             # Dossier pour les images uploadées
├── index.php            # Page d'accueil
├── news_details.php     # Détail d'une actualité
└── README.md            # Documentation du projet
```

---

## 🛠️ Maintenance et Dépannage

1. **Problème de connexion à la base de données** :
   - Vérifiez que votre serveur MySQL est démarré.
   - Assurez-vous que les informations dans `database.php` sont correctes.

2. **Erreur 404 lors de l'accès au site** :
   - Vérifiez que les fichiers sont bien placés dans le dossier `htdocs`.
   - Assurez-vous que vous accédez à la bonne URL (par exemple, [http://localhost/technipole-sup-valor](http://localhost/technipole-sup-valor)).

3. **CKEditor ne fonctionne pas** :
   - Vérifiez que le fichier JavaScript de CKEditor est bien inclus dans le projet.

---

## 📄 License

Ce projet est sous licence [MIT](https://opensource.org/licenses/MIT). Vous êtes libre de le modifier et de l'utiliser à des fins personnelles ou commerciales.

---

### 📞 Support

Pour toute question ou assistance, contactez-nous à [support@toggettech.org](mailto:support@toggettech.org).
