# Tri et défilement des tableaux de gestion

Les colonnes scalaires pertinentes et les relations simples utilisent le tri natif Filament : premier clic croissant, deuxième décroissant, troisième retour au tri par défaut. Les recherches, filtres, actions et permissions restent gérés par Filament. Le tri remet la pagination à la première page.

Les demandes conservent leur priorité métier puis leur date décroissante, les conversations leur dernière interaction décroissante, les galeries et leurs photos leur position. Ces ordres deviennent secondaires lorsqu’une colonne est choisie. Le tri de la relation publique `Gallery::images()` est préservé ; seul le tableau de gestion retire cet ordre imposé.

Périmètre : ressources éditoriales, demandes, contacts, conversations, audience, configuration, relation des photos, médiathèque et sélecteur média. Les grilles média conservent leurs aperçus et utilisent le sélecteur de tri natif Filament pour les noms, fichiers et types disponibles.

Les rapports de livraison permettent aussi de trier les dates de livraison, ouverture et clic, avec des valeurs chronologiques brutes. Les rapports de campagnes permettent le tri du nom et du canal. L’outil d’optimisation trie les chemins et poids bruts.

Les aperçus, chemins d’images décoratives, textes longs, relations multiples, dernier message calculé, totaux de livraison et indicateurs de synthèse ne reçoivent pas de nouveau tri. Les compteurs relationnels déjà triables par SQL restent disponibles.

Le style commun `resources/views/filament/table-styles.blade.php` est chargé uniquement dans l’administration. Il conserve la largeur intrinsèque des tableaux et contient le défilement horizontal dans leur zone, y compris dans les fiches et rapports. Il respecte la préférence de réduction des animations.

## Vérification

- `composer test` : suite complète, comprenant `AdminTableSortingTest` et `ReportSortingTest`.
- `npm ci --ignore-scripts && npm run build`.
- Vérifier au navigateur les deux clics sur un en-tête, les filtres/recherches et la pagination, puis les largeurs ordinateur et mobile.
- Vérifier les photos dans une fiche galerie et les rapports en fenêtre modale.
- Déployer selon `docs/deploiement-hostinger.md`, exclusivement à partir du commit poussé ; aucune migration n’est nécessaire pour cette évolution.
