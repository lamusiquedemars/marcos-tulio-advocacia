# État Acquisition — Marcos Túlio Advocacia

> Référence de reprise. Aucun secret, identifiant OAuth ou donnée client n’est stocké ici.

## Identité et responsabilités

| Élément | Valeur |
|---|---|
| Organisation / client | Marcos Túlio Advocacia |
| Domaine public | `https://marcostulioadvocacia.com.br` |
| Dépôt local | `/Users/ivocorreiademelo/Sites/marcos-tulio-advocacia` |
| Production / hébergement | À confirmer avant tout déploiement ou réglage Google. |
| Compte Google propriétaire | À fournir par Marcos. |
| Accès Maracuja | `ivo@maracujadigital.fr` doit recevoir l’administration, sans devenir propriétaire. |
| Compte Ads client | À créer/configurer par Marcos ou à identifier s’il existe déjà. |
| MCC Maracuja | À rattacher après accord de Marcos. |
| Pays / devise / fuseau | Brésil / BRL / `America/Cuiaba` prévus dans l’admin locale. |

## Décisions déjà prises

- Marcos reste propriétaire de ses comptes Google et de sa facturation.
- Le site possède déjà un module `Acquisition` : GTM, consentement, devise et fuseau se règlent dans son administration ; aucun identifiant Google réel n’est actuellement enregistré.
- Cremona est le cockpit métier ; Google Ads conserve la diffusion et la facturation.
- La première campagne restera un brouillon jusqu’à validation du tracking et accord explicite de Marcos.

## Étapes

| N° | Statut | Fait vérifiable / blocage | Prochaine action unique |
|---:|---|---|---|
| 0 | en cours | Organisation Marcos et brouillon interne `SEARCH | Criminal | Cuiabá` existent dans Cremona. | Confirmer l’objectif commercial et l’accord de Marcos. |
| 1 | en cours | Le code possède `sitemap.xml`, `robots.txt` et le module Acquisition. | Auditer la production réelle et les URLs publiques. |
| 2 | à préparer | Aucune propriété Search Console confirmée. | Marcos crée/partage la propriété Domaine. |
| 3 | à préparer | Aucun ID GTM réel enregistré dans l’admin. | Marcos crée un conteneur Web et donne accès à Maracuja. |
| 4 | à préparer | Code générique de consentement déjà présent. | Renseigner le seul ID GTM dans l’admin après création. |
| 5 | à préparer | Aucune GA4 confirmée. | Marcos crée GA4 et ajoute Maracuja administrateur. |
| 6 | à préparer | Aucun tag réel chargé. | Configurer la balise GA4 dans GTM et tester. |
| 7 | à préparer | Événements prévus : WhatsApp, téléphone, formulaire, consultation et chatbot. | Définir les conditions de succès et données autorisées. |
| 8 | à préparer | Aucun événement clé confirmé. | Marquer les événements validés dans GA4. |
| 9 | à préparer | Aucune association Search Console ↔ GA4 confirmée. | Créer l’association après les étapes 2 et 5. |
| 10 | à préparer | Aucun compte Ads client confirmé. | Marcos finalise son compte et accepte le rattachement MCC Maracuja. |
| 11 | à préparer | Dépend des événements GA4 et d’une campagne approuvée. | Importer les conversions GA4 juste avant diffusion. |
| 12 | en cours | Brouillon interne Cremona existe ; pas de campagne Google active. | Préparer mots-clés, exclusions, budget et validation client. |
| 13 | non applicable | Pas d’accord de lancement ni tracking validé. | — |
| 14 | à préparer | Cremona peut centraliser les demandes et les métriques ; API Google Ads réelle dépend encore de l’approbation API et de la mise en production. | Préparer la connexion seulement après les prérequis. |

## Journal succinct

- 2026-08-26 — Audit local : module Acquisition, sitemap et robots déjà présents ; aucune balise Google réelle détectée dans le code/configuration.
