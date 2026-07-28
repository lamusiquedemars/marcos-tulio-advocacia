# Déploiement LWS — avocat.maracujadigital.fr

## 1. Avant le déploiement

1. Sauvegarder les fichiers applicatifs, `storage/app` et la base MySQL partagée.
2. Vérifier que PHP 8.3.31+ et les extensions requises par Laravel sont actives.
3. Installer les dépendances sans développement et construire les assets :

```bash
composer install --no-dev --optimize-autoloader
npm ci
npm run build
```

Le dossier `vendor` et les assets `public/build` doivent être disponibles sur l'hébergement. Si Node.js n'est pas disponible chez LWS, construire les assets localement avant transfert.

## 2. Sous-domaine et document root

Dans le panneau LWS :

1. créer le sous-domaine `avocat.maracujadigital.fr` ;
2. activer son certificat TLS/HTTPS ;
3. faire pointer son document root vers le dossier `public` du projet, par exemple `/.../marcos-tulio-advocacia/public` ;
4. vérifier que la réécriture d'URL est active et que `/admin` atteint Filament.

Le document root vers `public` est obligatoire : `.env`, `vendor`, `storage` et le code PHP ne doivent pas être servis comme fichiers publics. Le `index.php` de compatibilité à la racine ne remplace pas cette configuration correcte.

## 3. Environnement

Créer `.env` à partir de `.env.production.example`, sans le versionner. Valeurs essentielles :

```dotenv
APP_ENV=production
APP_DEBUG=false
APP_URL=https://avocat.maracujadigital.fr
APP_KEY=
DB_CONNECTION=mysql
DB_PREFIX=avocat_
SESSION_COOKIE=maracuja_avocat_session
SESSION_DOMAIN=null
CACHE_PREFIX=maracuja_avocat_
MAIL_MAILER=log
MARACUJA_INDEXABLE=false
```

Renseigner les identifiants de l'unique base MySQL LWS. Générer sur le serveur une clé dédiée avec `php artisan key:generate`; ne jamais copier la clé d'une autre démonstration. `DB_PREFIX=avocat_` isole les tables au sein de la base partagée. Si LWS impose MariaDB, utiliser `DB_CONNECTION=mariadb` avec le même préfixe.

Laisser `MAIL_MAILER=log` tant qu'aucun envoi réel n'est explicitement validé. Les paramètres initiaux désactivent aussi les emails du formulaire.

## 4. Migrations et caches

Après sauvegarde et vérification du préfixe :

```bash
php artisan config:clear
php artisan migrate --force
php artisan config:cache
php artisan route:cache
php artisan view:cache
```

Ne jamais lancer `php artisan migrate:fresh`, `php artisan db:wipe`, `migrate:reset`, ni supprimer globalement des tables sur la base partagée. `migrate --force` ne doit être lancé qu'avec `DB_PREFIX=avocat_` vérifié.

Pour contrôler sans modifier :

```bash
php artisan about
php artisan migrate:status
php artisan maracuja:doctor
```

## 5. Stockage et permissions

Maracuja stocke directement les médias publics dans `public/storage`. Aucun
lien symbolique ne doit être créé. Préparer le dossier :

```bash
mkdir -p public/storage
chmod 775 public/storage
```

Le processus PHP doit pouvoir écrire dans `public/storage`, `storage` et
`bootstrap/cache`, et lire le reste du projet. Utiliser les permissions les
plus restrictives compatibles avec l'utilisateur PHP de LWS ; éviter `777`.
Vérifier l'upload et l'affichage d'un média factice depuis Filament.

## 6. Sauvegarde et retour arrière

Avant chaque mise à jour :

1. mettre le site en maintenance si nécessaire ;
2. exporter toute la base MySQL partagée avec l'outil LWS ou `mysqldump` ;
3. conserver une copie de `storage/app`, du `.env` chiffré/hors web et de la version Git déployée ;
4. vérifier que la sauvegarde est lisible et datée avant la migration.

Le projet fournit également `php artisan maracuja:database-backup`; valider sa configuration et son fichier de sortie sur LWS avant d'en faire l'unique sauvegarde.

En cas d'échec, remettre la version applicative précédente. Restaurer la base complète uniquement à partir d'une sauvegarde validée et en tenant compte des autres démonstrations qui la partagent. Ne pas tenter un nettoyage global de la base.

## 7. Vérifications après déploiement

- `https://avocat.maracujadigital.fr` répond en HTTPS ;
- `https://avocat.maracujadigital.fr/admin` affiche l'authentification Filament ;
- `/robots.txt` contient `Disallow: /` et les pages ont `noindex` ;
- la mention de démonstration est visible dans le pied de page ;
- aucun email réel n'est envoyé ;
- les tables créées dans la base partagée commencent par `avocat_` ;
- les logs ne contiennent ni secret ni récit sensible.
