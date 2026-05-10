#  Book Store - Library Management System



---

##  Description

**Book Store** est une application web de gestion de bibliothèque développée avec **Laravel** et **Bootstrap 5**.
Elle permet de gérer les livres, les auteurs, les emprunts et les utilisateurs de manière simple et efficace.

---

##  Modules

-  **Livres**
-  **Auteurs**
-  **Emprunts**
-  **Authentification**

---
##  Fonctionnalités

-  **Livres** — CRUD + image couverture + disponibilité
-  **Auteurs** — CRUD + biographie + nationalité
-  **Emprunts** — CRUD + statuts + export PDF & Excel
-  **Auth** — Inscription + Connexion + Laravel Sanctum
---

##  Technologies

![Laravel](https://img.shields.io/badge/Laravel-FF2D20?style=for-the-badge&logo=laravel&logoColor=white)
![PHP](https://img.shields.io/badge/PHP-777BB4?style=for-the-badge&logo=php&logoColor=white)
![MySQL](https://img.shields.io/badge/MySQL-005C84?style=for-the-badge&logo=mysql&logoColor=white)
![Bootstrap](https://img.shields.io/badge/Bootstrap-563D7C?style=for-the-badge&logo=bootstrap&logoColor=white)
![XAMPP](https://img.shields.io/badge/XAMPP-FB7A24?style=for-the-badge&logo=xampp&logoColor=white)
![Status](https://img.shields.io/badge/Status-Active-success?style=for-the-badge)

---

##  Base de données

| Table | Description |
|-------|-------------|
| `users` | Utilisateurs de la bibliothèque |
| `auteurs` | Auteurs des livres |
| `livres` | Catalogue des livres |
| `emprunts` | Gestion des emprunts |
| `migrations` | Migrations Laravel |
| `password_reset_tokens` | Réinitialisation mot de passe |
| `personal_access_tokens` | Tokens API |
| `failed_jobs` | Jobs échoués |

---

##  Installation

### Prérequis
- PHP >= 8.1
- Composer
- MySQL
- XAMPP

### Étapes

```bash
# 1. Cloner le projet
git clone https://github.com/sahlinour/Book-Store.git

# 2. Aller dans le dossier
cd Book-Store

# 3. Installer les dépendances
composer install

# 4. Copier le fichier .env
cp .env.example .env

# 5. Générer la clé
php artisan key:generate

# 6. Lancer les migrations
php artisan migrate

# 7. Créer le lien storage
php artisan storage:link

# 8. Lancer le serveur
php artisan serve
```

---

##  Configuration `.env`

```env
APP_NAME="Book Store"
APP_URL=http://localhost

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=book_store
DB_USERNAME=root
DB_PASSWORD=
```

---

##  Contributing

```bash
# 1. Fork le projet
# 2. Créer une branche
git checkout -b feature/NouvelleFonctionnalite

# 3. Commit
git commit -m "Add: Nouvelle fonctionnalité"

# 4. Push
git push origin feature/NouvelleFonctionnalite

# 5. Ouvrir une Pull Request
```
---

<div align="center">

⭐ **Si ce projet vous a aidé, n'hésitez pas à lui donner une étoile !** ⭐

**Made with ❤️ by Nour El Houda Sahli**

</div>
