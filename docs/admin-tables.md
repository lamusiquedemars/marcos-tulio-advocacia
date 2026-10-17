# Tri et défilement des tableaux de gestion

Les colonnes scalaires pertinentes et les relations simples utilisent le tri natif Filament : premier clic croissant, deuxième décroissant, troisième retour au tri par défaut. Les recherches, filtres, actions et permissions restent gérés par Filament. Le tri remet la pagination à la première page.

Les demandes conservent leur priorité métier puis leur date décroissante, les conversations leur dernière interaction décroissante, les galeries et leurs photos leur position. Ces ordres deviennent secondaires lorsqu’une colonne est choisie. Le tri de la relation publique `Gallery::images()` est préservé ; seul le tableau de gestion retire cet ordre imposé.

Périmètre : ressources éditoriales, demandes, contacts, conversations, audience, configuration, relation des photos, médiathèque et sélecteur média. Les grilles média conservent leurs aperçus et utilisent le sélecteur de tri natif Filament pour les noms, fichiers et types disponibles.

Les rapports de livraison permettent aussi de trier les dates de livraison, ouverture et clic, avec des valeurs chronologiques brutes. Les rapports de campagnes permettent le tri du nom et du canal. L’outil d’optimisation trie les chemins et poids bruts.

Les aperçus, chemins d’images décoratives, textes longs, relations multiples, dernier message calculé, totaux de livraison et indicateurs de synthèse ne reçoivent pas de nouveau tri. Les compteurs relationnels déjà triables par SQL restent disponibles.

Le style `resources/css/filament/admin/tables.css` est compilé par Vite et chargé uniquement dans l’administration via `resources/views/filament/table-styles.blade.php`. Les 21 tableaux Filament classiques (dont les photos d’une galerie) portent la classe `admin-data-table` sur leur racine `.fi-ta`. Leur vrai conteneur est `.admin-data-table .fi-ta-content-ctn`. Les rapports Blade et le journal d’optimisation réutilisent leur conteneur `.admin-table-scroll`. Les grilles de médias restent inchangées.

La solution reprend le défilement natif de Cremona (`feat/admin-interface-translations`, commits `80a6fee`, `e45a361`, `f313607`, `0ed759c`) : `overflow-x: scroll !important`, `overflow-y: hidden`, gouttière stable et barre native grise, y compris en thème sombre. La largeur minimale est adaptée à 48 rem pour les listes plus courtes de Marcos ; la largeur intrinsèque permet aux listes plus larges de dépasser cette valeur sans cacher de colonnes. Les menus natifs conservent leurs libellés complets avec retour à la ligne. Le menu de suivi des demandes utilise `dropdownTeleport()` et `dropdownAutoPlacement()` de Filament afin de sortir de la zone à `overflow-y: hidden` et de rester dans l’écran.

Le hook `resources/views/filament/hooks/table-wheel-scroll.blade.php` convertit la molette verticale seulement au-dessus du conteneur réel et tant qu’il reste du contenu à parcourir. Il laisse libres le zoom, les gestes horizontaux, les champs, les menus et le défilement de page aux extrémités. Il est enregistré une seule fois et reste compatible avec les mises à jour Livewire.

**Convention à conserver :** vérifier le DOM réel avant toute modification. La classe est sur le parent : ne pas utiliser `:has(.admin-data-table)`. Ne créer aucun slider, fausse barre de défilement, couleur de test ou commande supplémentaire pour remplacer la barre native. Ne masquer aucune colonne métier.

## Barres natives sur macOS

Ne pas appliquer simultanément `scrollbar-color` avec une couleur et les pseudo-éléments `::-webkit-scrollbar` dans Chromium/WebKit : la propriété standard prend le dessus et réactive les barres superposées masquées de macOS. Le CSS conserve `scrollbar-color: auto` dans ces moteurs ; les couleurs standard sont réservées aux moteurs sans ces pseudo-éléments. La barre reste native, grise et manipulable.

Les contrôles doivent mesurer la hauteur réellement réservée à la barre et déplacer son curseur natif, pas seulement vérifier `overflow-x` ou `scrollLeft`. Dans Playwright, retirer l’argument headless `--hide-scrollbars`, sinon les captures masquent précisément ce défaut. Le test `admin-table-scrollbar.test.mjs` vérifie les tableaux et rapports dans les deux thèmes.

## Vérification

- `composer test` : suite complète, comprenant `AdminTableSortingTest` et `ReportSortingTest`.
- `npm ci --ignore-scripts && npm run build` ; vérifier l’entrée `resources/css/filament/admin/tables.css` dans `public/build/manifest.json`.
- `npx playwright install chromium` si le navigateur de test n’est pas déjà installé, puis `npm run test:admin-tables` après le build : visibilité et manipulation de la barre native, molette, extrémités, contrôles et enregistrement unique.
- Vérifier au navigateur les deux clics sur un en-tête, les filtres/recherches et la pagination, puis les largeurs ordinateur et mobile.
- Vérifier les photos dans une fiche galerie et les rapports en fenêtre modale.
- Déployer selon `docs/deploiement-hostinger.md`, exclusivement à partir du commit poussé ; aucune migration n’est nécessaire pour cette évolution.

La livraison de cette correction doit inclure les fichiers applicatifs modifiés **et** `public/build` compilé depuis le commit poussé, dans `app/public/build` puis `public_html/build`. Ne supprimer aucun ancien asset et conserver le front controller et le lien `storage` du serveur. Rafraîchir `config:cache`, `route:cache` et `view:cache` après transfert.
