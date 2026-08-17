# Déploiement Hostinger — marcostulioadvocacia.com.br

## Architecture

- Application Laravel privée : `/home/u424344637/domains/marcostulioadvocacia.com.br/app`
- Racine web publique : `/home/u424344637/domains/marcostulioadvocacia.com.br/public_html`
- PHP : 8.4
- Base : MariaDB sur `localhost`, avec `DB_PREFIX=avocat_`
- Alias SSH local : `marcos-tulio-admin`

Le code applicatif, `.env`, `vendor` et `storage` restent hors du webroot. Le
fichier `public_html/index.php` charge Laravel depuis le dossier voisin `app`.
`public_html/storage` est un lien vers `../app/public/storage`.

## Préparation

```bash
composer test
npm ci
npm run build
```

Le fichier local `.env.production.local` contient les secrets de production. Il
est en mode `600` et exclu de Git. Ne jamais le joindre à une archive ni le
copier dans `public_html`.

## Mise à jour applicative

Transférer le code dans `app`, sans `.git`, `.env`, `node_modules`, les
dépendances de développement ni les fichiers temporaires. Installer les
dépendances avec Composer. Comme `proc_open` est désactivé sur cet hébergement,
terminer les scripts Laravel directement :

```bash
composer dump-autoload --no-dev --optimize --no-scripts --no-interaction
php artisan package:discover
php artisan filament:upgrade
```

Synchroniser ensuite `app/public` vers `public_html`, sans remplacer le lien
`public_html/storage`, puis conserver le front controller Hostinger dédié.

## Base et caches

Avant chaque migration, vérifier la sauvegarde, la connexion `mariadb` et le
préfixe `avocat_`. Ne jamais lancer `migrate:fresh`, `db:wipe` ou une commande
équivalente en production.

```bash
php artisan migrate --force
php artisan config:cache
php artisan route:cache
php artisan view:cache
```

## Vérifications

- `https://marcostulioadvocacia.com.br` répond en HTTPS ;
- `/admin` redirige vers l’authentification Filament ;
- les assets `/build`, `/css`, `/js` et les médias `/storage` répondent ;
- `robots.txt` bloque l’indexation tant que `MARACUJA_INDEXABLE=false` ;
- aucun secret ni ancien domaine n’apparaît dans les pages ou les caches.
