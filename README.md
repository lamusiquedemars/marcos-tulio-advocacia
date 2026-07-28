# Marcos Túlio Advocacia

Site de Marcos Túlio Advocacia, construit avec Laravel 13, Filament 4 et le frontend Blade de Maracuja CMS.

Toutes les identités, coordonnées et données de contact présentes dans l'installation initiale sont fictives. Le projet reste non indexable et les emails utilisent le transport `log`.

## Installation locale

Prérequis : PHP 8.3.31+, Composer, Node.js/npm, MySQL 8 ou MariaDB et l'extension PHP PDO MySQL.

```bash
cp .env.example .env
composer install
php artisan key:generate
php artisan migrate --seed
npm install
npm run build
mkdir -p public/storage
php artisan serve
```

Créer auparavant les bases MySQL locales `marcos_tulio_advocacia` et `marcos_tulio_advocacia_testing`. Ne copie jamais une `APP_KEY` depuis un autre site : `php artisan key:generate` crée celle de cette installation.

Administration : `http://127.0.0.1:8000/admin`. Compte de démonstration local : `admin@avocat.test` / `password`. Change ou supprime ce mot de passe avant toute exposition publique.

Tests :

```bash
composer test
```

Le cahier des charges fonctionnel se trouve dans `CODEX_SITE_MARCOS_TULIO.md`. Le déploiement est détaillé dans `docs/deploiement-lws.md`.

## Sécurité des bases partagées

En production, les tables utilisent `DB_PREFIX=avocat_`. Les connexions Laravel `mysql` et `mariadb` appliquent ce préfixe, y compris aux tables référencées par les clés étrangères. Les noms d'index Laravel restent compatibles avec MySQL/MariaDB et ne sont pas artificiellement allongés avec le préfixe.

> Sur la base de production partagée, ne jamais exécuter `php artisan migrate:fresh`, `php artisan db:wipe`, ni une commande équivalente de suppression globale.
