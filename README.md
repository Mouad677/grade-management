# Système de Gestion des Notes

Un système moderne de gestion des notes pour les établissements d'enseignement, développé avec Laravel.

## Prérequis

- PHP >= 8.1
- Composer
- MySQL
- Node.js & NPM (pour les assets)

## Installation

1. **Cloner le projet**
   ```bash
   git clone [URL_DU_REPO]
   cd system-management
   ```

2. **Installer les dépendances PHP**
   ```bash
   composer install
   ```

3. **Configurer l'environnement**
   ```bash
   cp .env.example .env
   php artisan key:generate
   ```

4. **Configurer la base de données**
   - Ouvrir le fichier `.env`
   - Modifier les paramètres de la base de données :
     ```
     DB_CONNECTION=mysql
     DB_HOST=127.0.0.1
     DB_PORT=3306
     DB_DATABASE=system_management
     DB_USERNAME=root
     DB_PASSWORD=
     ```

5. **Créer la base de données**
   ```bash
   php artisan migrate
   ```

6. **Remplir la base de données avec les données de test**
   ```bash
   php artisan db:seed
   ```

7. **Installer les dépendances NPM et compiler les assets**
   ```bash
   npm install
   npm run dev
   ```

8. **Lancer le serveur de développement**
   ```bash
   php artisan serve
   ```

## Accès au système

- URL : http://localhost:8000
- Compte administrateur par défaut :
  - Email : admin@example.com
  - Mot de passe : password
- Compte étudiant par défaut :
  - Email : student@example.com
  - Mot de passe : password

## Fonctionnalités

- Gestion des utilisateurs (Admin)
- Gestion des notes
- Tableau de bord personnalisé
- Interface responsive
- Système d'authentification
- Gestion des rôles (Admin/Étudiant)

## Structure du projet

```
system-management/
├── app/
│   ├── Http/
│   │   ├── Controllers/
│   │   └── Middleware/
│   ├── Models/
│   └── Services/
├── database/
│   ├── migrations/
│   └── seeders/
├── resources/
│   ├── views/
│   └── css/
├── routes/
│   └── web.php
└── tests/
```

## Développement

Pour le développement, vous pouvez utiliser :
```bash
npm run dev
```

Pour la production :
```bash
npm run build
```

## Tests

Pour exécuter les tests :
```bash
php artisan test
```

## Support

Pour toute question ou problème, veuillez créer une issue dans le repository.

## Licence

Ce projet est sous licence MIT.
