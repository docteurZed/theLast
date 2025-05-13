# theLast

Application Laravel développée pour un événement de promotion universitaire.

## 🚀 Fonctionnalités

- Gestion des tâches et sous-tâches
- Attribution des tâches aux utilisateurs
- Interface d'administration
- Authentification utilisateur

## 🛠️ Technologies

- Laravel 10+
- PHP 8.2+
- MySQL
- Bootstrap / TailwindCSS
- JavaScript


## 📦 Installation

1. Cloner le dépôt :

```bash
git clone https://github.com/docteurZed/theLast.git
cd theLast

2. Installer les dépendances :
composer install
npm install && npm run build

3. Copier le fichier .env.example et le renommer en .env :
cp .env.example .env

4. Générer la clé de l'application :
php artisan key:generate

5. Configurer la base de données dans .env, puis exécuter les migrations :
php artisan migrate

6. Créer les données par défaut
php artisan app:default


## 🧪 Utilisation
1. Lancer le serveur local :
php artisan serve

2. Accéder à l'application via http://localhost:8000