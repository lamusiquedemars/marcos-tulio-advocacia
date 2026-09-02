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
| 0 | fait | Organisation Marcos et campagne sont cadrées pour générer des demandes de contact qualifiées en droit pénal au Mato Grosso. | Suivre les premiers résultats sans modifier la structure. |
| 1 | en cours | `sitemap.xml`, `robots.txt` et le module Acquisition sont déployés ; la page publique HTTPS répond. | Auditer les URLs et l’indexation réelles. |
| 2 | fait | Le 1er septembre 2026, la propriété Domaine Search Console `marcostulioadvocacia.com.br` a été validée via un TXT DNS Registro.br. | Attendre les premières données de requêtes. |
| 3 | fait | Conteneur Web GTM créé par Maracuja pour le domaine. | Ajouter Marcos administrateur GTM dès qu’il est disponible. |
| 4 | fait en production | ID GTM configuré ; bannière portugaise déployée, consentement `basic` et absence de chargement direct vérifiés. | Tester le refus et l’acceptation dans un navigateur avant publication GTM. |
| 5 | fait | Propriété GA4 et flux Web créés par Maracuja. | Ajouter Marcos administrateur GA4 dès qu’il est disponible. |
| 6 | fait | Le 1er septembre 2026, Tag Assistant a confirmé la balise GA4 ; le conteneur GTM a ensuite été publié. | Vérifier une collecte réelle dans GA4. |
| 7 | fait pour le lancement | Le 1er septembre 2026, `whatsapp_click`, `phone_click` et `generate_lead` ont été confirmés dans GTM Preview, avec leurs balises GA4 déclenchées, puis publiées dans GTM. La mesure de consultation par bouton radio est reportée ; elle ne bloque pas le lancement. | Vérifier une collecte réelle dans GA4. |
| 8 | fait | `generate_lead` est confirmé comme événement clé GA4, sans valeur monétaire par défaut et comptabilisé une fois par événement. | Contrôler les premières conversions réelles. |
| 9 | fait | Le 1er septembre 2026, la propriété Search Console `marcostulioadvocacia.com.br` a été associée au flux GA4 `G-R2YMNR6NG0`. | Attendre les premières données SEO. |
| 10 | fait | Compte Ads Marcos visible `Actif` dans le MCC Maracuja et associé au flux GA4 `G-R2YMNR6NG0`. | Surveiller la diffusion et les alertes Google Ads. |
| 11 | fait | Le 1er septembre 2026, l’événement clé GA4 `generate_lead` a été importé dans Google Ads sous le nom `Enviar formulário de lead`. Aucun snippet Google Ads supplémentaire n’est installé. | Vérifier les premières conversions importées. |
| 12 | fait | Budget R$ 25/jour, objectif `Enviar formulário de lead` uniquement, État de Mato Grosso avec présence locale ; mots-clés et annonces existent. | Ne modifier qu’après analyse des premières données. |
| 13 | en cours | Le 2 septembre 2026, Ivo a activé la campagne dans Google Ads ; son statut est `Em aprendizado`. | Faire un premier contrôle après 24 à 48 heures. |
| 14 | à préparer | Cremona peut centraliser les demandes et les métriques ; API Google Ads réelle dépend encore de l’approbation API et de la mise en production. | Préparer la connexion seulement après les prérequis. |

## Journal succinct

- 2026-08-26 — Audit local : module Acquisition, sitemap et robots déjà présents ; aucune balise Google réelle détectée dans le code/configuration.
- 2026-08-28 — GA4 et GTM créés par Maracuja. Balise GA4 enregistrée dans GTM sans publication ; configuration GTM enregistrée en local avec consentement `basic`. Compte Ads Marcos créé et demande de rattachement MCC en attente de sa vérification d’identité.
- 2026-08-28 — Bannière de consentement Acquisition ajoutée localement : textes portugais, accepter ou recusar, choix mémorisé 180 jours. Elle accorde uniquement la mesure Analytics ; le consentement publicitaire reste refusé.
- 2026-08-28 — Module Acquisition déployé : quatre migrations exécutées, configuration GTM de production activée avec consentement `basic`, caches reconstruits. Vérification HTTPS : bannière affichée et aucun script GTM chargé directement avant consentement.
- 2026-08-30 — Marcos a accepté le rattachement : son compte Google Ads apparaît `Actif` dans le compte gestionnaire Maracuja. Seul le numéro client est affiché dans la liste ; aucune campagne n’a été modifiée.
- 2026-09-01 — Prévisualisation GTM du site public : la balise GA4 apparaît dans `Tags Fired` sur l’événement `Page View`. La preuve de l’étape 6 est obtenue ; aucune publication GTM n’a encore été faite.
- 2026-09-01 — Événement `whatsapp_click` : la balise GTM `GA4 — WhatsApp click` a été créée puis confirmée dans `Tags Fired` lors de la prévisualisation. Le conteneur n’est pas publié.
- 2026-09-01 — Événement `phone_click` : la balise GTM `GA4 — Phone click` a été créée puis confirmée dans `Tags Fired` lors de la prévisualisation. Le conteneur n’est pas publié.
- 2026-09-01 — Événement `generate_lead` : la balise GTM `GA4 — Generate lead` a été créée puis confirmée dans `Tags Fired` après un envoi de formulaire de test. La mesure de consultation via le choix radio est reportée ; elle n’empêche pas la validation du socle de lancement.
- 2026-09-01 — `generate_lead` confirmé comme événement clé dans GA4 : sans valeur monétaire par défaut, comptabilisation une fois par événement.
- 2026-09-01 — La propriété Domaine Search Console `marcostulioadvocacia.com.br` a été validée par TXT DNS chez Registro.br.
- 2026-09-01 — Liaison Search Console ↔ GA4 créée pour la propriété Domaine `marcostulioadvocacia.com.br` et le flux Web `G-R2YMNR6NG0`.
- 2026-09-01 — Conteneur GTM publié : version `Marcos Túlio — Conversões iniciais GA4`, avec GA4, `generate_lead`, `whatsapp_click` et `phone_click`.
- 2026-09-01 — Flux GA4 `G-R2YMNR6NG0` associé au compte Google Ads client Marcos `961-809-6095`.
- 2026-09-01 — Événement clé GA4 `generate_lead` importé dans Google Ads comme conversion `Enviar formulário de lead`, sans ajout d’un second code de suivi.
- 2026-09-01 — Campagne Google Ads Marcos configurée avec un objectif de conversion spécifique : `Enviar formulário de lead` uniquement. Les autres objectifs de compte ne guident plus ses enchères.
- 2026-09-01 — Ciblage géographique corrigé : État de Mato Grosso (Brésil) uniquement. Cuiabá, Gramado (RS) et Iporá (GO), qui formaient une liste incohérente, ont été retirés.
- 2026-09-01 — Option de ciblage géographique réglée sur la présence habituelle dans les lieux ciblés.
- 2026-09-02 — Campagne Marcos activée dans Google Ads avec l’autorisation explicite d’Ivo. Statut observé : `Em aprendizado`.
