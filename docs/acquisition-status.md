# État Acquisition — Marcos Túlio Advocacia

> Référence de reprise. Aucun secret, identifiant OAuth ou donnée client n’est stocké ici.

## Identité et responsabilités

| Élément | Valeur |
|---|---|
| Organisation / client | Marcos Túlio Advocacia |
| Domaine public | `https://marcostulioadvocacia.com.br` |
| Dépôt local | `/Users/ivocorreiademelo/Sites/marcos-tulio-advocacia` |
| Production / hébergement | Déployé le 28 août 2026 ; HTTPS public vérifié. |
| Compte Google propriétaire | Compte Marcos créé ; la vérification d’identité est en attente. |
| Accès Maracuja | `ivo@maracujadigital.fr` administre les outils de mesure ; Marcos doit être ajouté administrateur à son réveil. |
| Compte Ads client | Créé par Marcos ; campagnes imposées par le parcours Google conservées en brouillon. |
| MCC Maracuja | Compte Marcos rattaché et visible avec le statut `Actif` dans le compte gestionnaire Maracuja le 30 août 2026. |
| Pays / devise / fuseau | Brésil / BRL / `America/Cuiaba` prévus dans l’admin locale. |

## Décisions déjà prises

- Marcos reste propriétaire de Google Ads et de sa facturation. Maracuja peut provisionner GA4 et GTM, puis ajoute Marcos administrateur afin qu’il conserve un accès durable.
- Le site possède déjà un module `Acquisition` : GTM, consentement, devise et fuseau se règlent dans son administration. Le conteneur GTM réel est configuré localement en consentement `basic`, sans déploiement de production.
- Cremona est le cockpit métier ; Google Ads conserve la diffusion et la facturation.
- La première campagne restera un brouillon jusqu’à validation du tracking et accord explicite de Marcos.

## Étapes

| N° | Statut | Fait vérifiable / blocage | Prochaine action unique |
|---:|---|---|---|
| 0 | en cours | Organisation Marcos et brouillon interne `SEARCH | Criminal | Cuiabá` existent dans Cremona. | Confirmer l’objectif commercial et l’accord de Marcos. |
| 1 | en cours | `sitemap.xml`, `robots.txt` et le module Acquisition sont déployés ; la page publique HTTPS répond. | Auditer les URLs et l’indexation réelles. |
| 2 | à préparer | Aucune propriété Search Console confirmée. | Marcos crée/partage la propriété Domaine. |
| 3 | fait | Conteneur Web GTM créé par Maracuja pour le domaine. | Ajouter Marcos administrateur GTM dès qu’il est disponible. |
| 4 | fait en production | ID GTM configuré ; bannière portugaise déployée, consentement `basic` et absence de chargement direct vérifiés. | Tester le refus et l’acceptation dans un navigateur avant publication GTM. |
| 5 | fait | Propriété GA4 et flux Web créés par Maracuja. | Ajouter Marcos administrateur GA4 dès qu’il est disponible. |
| 6 | en cours | Balise GA4 créée dans GTM, non publiée ; aucun tag Analytics ne collecte encore de données. | Prévisualiser GTM après le test du consentement, puis publier uniquement avec accord. |
| 7 | fait localement | Événements anonymes instrumentés : WhatsApp, téléphone, intention de rendez-vous, formulaire enregistré et demande de rappel chatbot. | Vérifier les signaux dans GTM Preview après consentement. |
| 8 | à préparer | Aucun événement clé confirmé. | Marquer les événements validés dans GA4. |
| 9 | à préparer | Aucune association Search Console ↔ GA4 confirmée. | Créer l’association après les étapes 2 et 5. |
| 10 | fait | Compte Ads Marcos visible `Actif` dans le MCC Maracuja. La campagne Google existante reste en brouillon. | Relever le nom commercial du compte seulement si utile ; ne pas modifier la campagne. |
| 11 | à préparer | Dépend des événements GA4 et d’une campagne approuvée. | Importer les conversions GA4 juste avant diffusion. |
| 12 | en cours | Brouillon interne Cremona existe ; pas de campagne Google active. | Préparer mots-clés, exclusions, budget et validation client. |
| 13 | non applicable | Pas d’accord de lancement ni tracking validé. | — |
| 14 | à préparer | Cremona peut centraliser les demandes et les métriques ; API Google Ads réelle dépend encore de l’approbation API et de la mise en production. | Préparer la connexion seulement après les prérequis. |

## Journal succinct

- 2026-08-26 — Audit local : module Acquisition, sitemap et robots déjà présents ; aucune balise Google réelle détectée dans le code/configuration.
- 2026-08-28 — GA4 et GTM créés par Maracuja. Balise GA4 enregistrée dans GTM sans publication ; configuration GTM enregistrée en local avec consentement `basic`. Compte Ads Marcos créé et demande de rattachement MCC en attente de sa vérification d’identité.
- 2026-08-28 — Bannière de consentement Acquisition ajoutée localement : textes portugais, accepter ou recusar, choix mémorisé 180 jours. Elle accorde uniquement la mesure Analytics ; le consentement publicitaire reste refusé.
- 2026-08-28 — Module Acquisition déployé : quatre migrations exécutées, configuration GTM de production activée avec consentement `basic`, caches reconstruits. Vérification HTTPS : bannière affichée et aucun script GTM chargé directement avant consentement.
- 2026-08-30 — Marcos a accepté le rattachement : son compte Google Ads apparaît `Actif` dans le compte gestionnaire Maracuja. Seul le numéro client est affiché dans la liste ; aucune campagne n’a été modifiée.
