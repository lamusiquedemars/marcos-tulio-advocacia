# Projet — Site Marcos Túlio

## Mission

Construire le site de **Marcos Túlio, avocat pénaliste à Cuiabá**, sur la base de Maracuja CMS.

Le projet est actuellement en **mode démonstration**. Cela ne signifie pas créer une maquette jetable : l’interface, les modèles de données et les modules doivent être conçus pour devenir la version de production sans réécriture inutile. En revanche, ne pas connecter de comptes réels, ne pas traiter de vraies données clients et ne pas inventer les informations professionnelles qui n’ont pas encore été fournies.

Le site et son administration sont en **portugais brésilien**. Le code, les noms techniques et la documentation interne suivent les conventions déjà présentes dans Maracuja.

## Avant de modifier le projet

1. Inspecter la structure existante, les conventions Maracuja, les modules déjà disponibles, les composants Blade, les ressources Filament, les migrations, les tests et le système de thèmes.
2. Réutiliser les composants et services existants avant d’en créer de nouveaux.
3. Ne pas introduire une seconde architecture parallèle ou un framework frontal supplémentaire.
4. Établir un plan court par lots fonctionnels, puis implémenter et tester un lot à la fois.
5. Préserver les modifications déjà présentes dans le dépôt.

Stack attendue si le projet suit bien Maracuja : **Laravel, Filament, Blade, CSS maison et JavaScript progressif**. Si le dépôt diffère, suivre le dépôt et signaler l’écart avant toute décision structurelle importante.

## Positionnement du site

Le site doit répondre à deux comportements très différents :

- une personne en situation pénale urgente doit pouvoir contacter Marcos directement, sans formulaire ni chatbot obligatoire ;
- une personne qui veut expliquer ou faire analyser sa situation doit pouvoir être guidée, laisser une demande claire et solliciter une consultation.

Le site ne doit être ni une simple carte de visite, ni un portail juridique volumineux. Il doit présenter une autorité professionnelle concrète, montrer Marcos en situation de défense et organiser le premier contact.

Éléments différenciants connus :

- avocat pénaliste ;
- professeur de droit pénal depuis dix ans ;
- auteur de *O Pacote Anticrime Comentado* ;
- importance particulière de la **sustentação oral** ;
- intervention en présentiel à Cuiabá et à distance dans tout le Brésil.

Ne pas inventer son numéro OAB, ses établissements d’enseignement, son adresse, ses années d’exercice, les références éditoriales du livre, des résultats obtenus ou des témoignages.

## Architecture publique validée

Le site comprend cinq pages principales.

### 1. Início

L’accueil doit fonctionner même si le visiteur ne consulte aucune autre page, mais rester synthétique. Il comprend :

- une ouverture claire sur la défense pénale à Cuiabá et dans tout le Brésil ;
- deux accès visibles : urgence par WhatsApp et présentation guidée du cas ;
- un aperçu court des situations prises en charge ;
- une mise en avant de la sustentação oral avec une seule vidéo principale ;
- une preuve d’autorité courte : professeur depuis dix ans et auteur du livre ;
- une explication simple du fonctionnement de la prise en charge, y compris à distance ;
- un dernier accès au contact.

### 2. Atuação Penal

Une seule page structurée par situations, sans créer une sous-page par service :

- prisão, busca e apreensão ;
- investigação, intimação et depoimento ;
- processo penal ;
- recursos et habeas corpus ;
- consultoria preventiva.

Cette page explique quand Marcos intervient et oriente vers le contact. Elle ne doit pas devenir un cours de droit ni promettre un résultat.

### 3. Sustentações e Defesas

Cette page est une sélection professionnelle, pas une copie d’Instagram ni une vidéothèque infinie.

- une vidéo principale ;
- jusqu’à six vidéos secondaires publiées ;
- pour chaque vidéo : titre, lien ou média, contexte court, ordre et état de publication ;
- possibilité de présenter des exemples de défenses autorisés et anonymisés : situation initiale, question juridique, stratégie et intervention réalisée ;
- aucune promesse de résultat et aucune donnée permettant d’identifier un client.

Lorsqu’une nouvelle vidéo est mise en avant au-delà de la limite, l’administration doit demander d’en retirer ou d’en archiver une autre. Ne jamais supprimer automatiquement un contenu.

### 4. Marcos Túlio

Présenter sans produire un CV exhaustif :

- portrait et présentation ;
- parcours d’avocat, uniquement avec les informations vérifiées ;
- dix années d’enseignement en droit pénal ;
- livre *O Pacote Anticrime Comentado* ;
- manière de préparer et de porter une défense ;
- liens vers les sustentações et vers la prise de contact.

### 5. Atendimento e Contato

La page distingue clairement :

- urgence pénale : WhatsApp direct ;
- situation à expliquer : assistant ou formulaire confidentiel ;
- demande de consultation ;
- consultation en présentiel ou à distance ;
- informations de confidentialité et consentement.

Prévoir aussi les pages légales nécessaires, mais ne pas rédiger comme définitifs des textes juridiques non validés.

## Navigation et conversions

Deux parcours principaux doivent rester visibles sur l’ensemble du site.

### Urgence

`Page consultée → WhatsApp → échange humain`

Le chatbot ne doit jamais bloquer ce parcours.

### Analyse ou consultation

`Assistant ou formulaire → qualification minimale → résumé → demande transmise → traitement par Marcos`

Une page ne doit pas être ajoutée sans rôle clair dans l’un de ces parcours ou dans la construction de la confiance.

## Administration attendue

L’administration doit être construite autour des tâches de Marcos, pas autour d’un constructeur de pages générique.

### Contenus essentiels

Permettre la modification des textes et médias prévus par la structure, sans permettre de casser librement la mise en page.

### Vidéos et défenses

Créer ou adapter un module administrable permettant de :

- ajouter une vidéo par lien ou par le mécanisme média déjà disponible ;
- saisir un titre et un contexte court ;
- choisir une vidéo principale ;
- ordonner les contenus ;
- publier, dépublier et archiver ;
- faire respecter la règle d’une principale et de six secondaires maximum publiées ;
- gérer les exemples anonymisés de défenses si ce type de contenu est activé.

Préférer une contrainte métier explicite et testée à une simple consigne affichée dans l’interface.

### Demandes d atendimento

Créer une vue simple des demandes reçues depuis le formulaire ou l’assistant. Données minimales envisagées :

- nom ;
- moyen de contact ;
- type de demande ;
- degré d’urgence ;
- phase générale de la situation ;
- échéance éventuelle ;
- localisation ;
- préférence présentiel ou visioconférence ;
- résumé ;
- consentement et date du consentement ;
- source de la demande ;
- statut de suivi.

Statuts simples : `nova`, `em_contato`, `consulta_solicitada`, `agendada`, `encerrada`. Adapter ces valeurs aux conventions du projet et ne pas créer un CRM juridique complet.

## Assistant conversationnel

L’assistant est une couche transversale du site, accessible dès l’accueil et depuis les pages principales.

Il peut :

- reconnaître le type de situation et l’urgence ;
- recueillir seulement les premières informations nécessaires ;
- répondre aux questions générales sur le fonctionnement du cabinet ;
- structurer et résumer la demande ;
- orienter vers WhatsApp ou vers une demande de consultation.

Il ne peut pas :

- donner un avis juridique personnalisé ;
- annoncer les chances de succès ;
- promettre un résultat ;
- se présenter comme Marcos ;
- demander le dépôt complet d’un dossier ;
- obliger une personne en urgence à poursuivre la conversation.

### Protection des données

Le domaine est sensible. Appliquer par défaut la minimisation des données :

- consentement explicite avant la transmission ;
- ne pas envoyer à Brevo le récit détaillé du dossier ;
- séparer les coordonnées marketing des données liées à une affaire ;
- ne jamais écrire de données sensibles dans les logs applicatifs ;
- prévoir une durée de conservation configurable ;
- garder les secrets exclusivement dans l’environnement ;
- ne connecter un fournisseur d’IA réel qu’après validation de sa configuration de confidentialité et de rétention.

En mode démo, le parcours doit pouvoir fonctionner avec des réponses simulées ou un fournisseur factice. L’interface métier ne doit pas dépendre directement du SDK d’un fournisseur précis.

## Rendez-vous et visioconférence

Le raisonnement produit est le suivant : Maracuja gère le parcours du site et la demande ; **Brevo Meetings** est le fournisseur privilégié pour les disponibilités, réservations, confirmations et rappels ; Google Meet, Zoom ou la visio Brevo peuvent fournir le lien de visioconférence.

Cependant, ne pas supposer qu’une API publique Brevo permet de créer depuis Maracuja un meeting à une date choisie par Marcos. Cette capacité n’est pas considérée comme acquise.

Construire le module avec une frontière claire :

- demande de consultation appartenant à Maracuja ;
- lien vers une page de réservation Brevo lorsque ce parcours est choisi ;
- identifiants et statuts externes stockés proprement si une synchronisation est disponible ;
- fournisseur d’agenda interchangeable, sans disperser du code Brevo dans les modèles ou ressources Filament ;
- fonctionnement local/factice complet en mode démo.

Prévoir deux modes configurables, sans imposer les deux à Marcos :

1. Marcos examine la demande et propose ensuite un horaire ;
2. le visiteur choisit directement un créneau dans Brevo Meetings.

Les fuseaux horaires doivent être explicites. Le fuseau professionnel par défaut sera `America/Cuiaba`, les dates persistées selon les conventions Laravel du projet, puis affichées dans le fuseau utile à l’utilisateur.

## Documents et espace client : non confirmé

Marcos a évoqué la gestion de documents clients, mais le besoin exact reste à confirmer.

Deux périmètres sont possibles :

1. **gestion interne** : Marcos classe des documents par client et par affaire ;
2. **espace client** : le client s’authentifie, dépose et consulte les documents autorisés de ses propres affaires.

Ne pas développer maintenant un espace client complet. Ne pas supposer non plus qu’une simple médiathèque suffit à sécuriser des pièces pénales.

Il est permis de préparer les points d’extension nécessaires si cela ne crée pas de code spéculatif important. Toute implémentation de documents réels ou de portail devra inclure authentification, autorisations par affaire, stockage privé, téléchargements contrôlés, journalisation des opérations et règles de conservation. Elle fera l’objet d’un lot séparé après validation du besoin.

## Mode démonstration

Le mode démo doit permettre de présenter tous les parcours confirmés sans utiliser de données ni de comptes réels.

- créer des données de démonstration clairement fictives ;
- utiliser des numéros, adresses, identifiants et liens factices ou explicitement fournis ;
- ne pas inventer de résultats judiciaires ni de dossiers ressemblant à de vraies personnes ;
- utiliser des adaptateurs factices pour IA, notifications, Brevo et rendez-vous ;
- rendre les actions destructives ou externes inoffensives en démo ;
- fournir une remise à zéro déterministe des données de démonstration si le projet possède déjà ce mécanisme ;
- conserver les mêmes contrats de service entre le mode démo et la production.

Le contenu de démonstration doit être crédible et rédigé en portugais brésilien, mais signalé dans le code ou les seeders comme contenu à valider. Éviter le lorem ipsum.

## Règles de conception

- Design sobre, professionnel, humain et crédible ; éviter les clichés visuels de marteau de juge, menottes ou tribunal monumental si ces éléments n’ont pas été expressément choisis.
- Responsive, accessible au clavier, contrastes suffisants et états de focus visibles.
- WhatsApp et assistant accessibles sans devenir des éléments flottants envahissants.
- Ne pas afficher de métriques, récompenses, avis ou logos institutionnels non fournis.
- Ne pas dupliquer automatiquement le flux Instagram.
- Ne pas créer de blog, page par service, CRM juridique lourd, facturation, signature électronique ou messagerie client dans ce lot.
- Tous les contenus éditables doivent rester encadrés par la structure conçue.

## Modèle de données indicatif

Ce modèle n’est pas une instruction pour dupliquer des tables déjà présentes. Réutiliser les modules Maracuja existants et adapter les noms aux conventions du dépôt.

- `videos` ou contenu équivalent : titre, slug éventuel, URL/média, contexte, position, principale, état, dates de publication ;
- `defense_cases` éventuel : titre public, situation, question, stratégie, intervention, anonymisé, état, position ;
- `service_requests` : identité minimale, coordonnées, catégorie, urgence, phase, échéance, localisation, modalité, résumé, consentement, source, statut ;
- `appointment_requests` uniquement si ce concept n’est pas déjà couvert proprement par les demandes ; éviter deux tables qui représentent la même chose ;
- références externes de rendez-vous dans une table d’intégration ou des champs clairement isolés.

Éviter de créer dès maintenant `clients`, `cases` et `documents` si le besoin documentaire n’est pas confirmé et si ces entités ne sont pas nécessaires aux fonctions validées.

## Ordre d’implémentation conseillé

### Lot 0 — Audit et base démo

- inspecter le projet ;
- identifier les composants et modules réutilisables ;
- confirmer le mécanisme de thème et de mode démo ;
- définir les tests de parcours prioritaires.

### Lot 1 — Site public

- structure des cinq pages ;
- navigation, pied de page et actions globales ;
- contenu démo en portugais brésilien ;
- responsive et accessibilité de base.

### Lot 2 — Sustentações e Defesas

- modèle, migration et resource Filament si nécessaire ;
- vidéo principale, ordre, publication et archivage ;
- limite métier testée ;
- rendu public de la sélection.

### Lot 3 — Atendimento

- formulaire minimal ;
- consentement ;
- stockage et statuts ;
- notifications factices en démo ;
- administration des demandes.

### Lot 4 — Assistant

- interface conversationnelle ;
- orchestration indépendante du fournisseur ;
- scénario factice complet ;
- résumé et création d’une demande ;
- garde-fous juridiques et de confidentialité.

### Lot 5 — Rendez-vous

- configuration des deux parcours possibles ;
- intégration par adaptateur ;
- lien Brevo Meetings en première approche ;
- webhooks ou synchronisation seulement si les capacités réellement documentées et les identifiants sont disponibles ;
- tests du fournisseur factice.

### Lot ultérieur — Documents / espace client

Ne commencer qu’après réponse de Marcos sur le besoin exact et validation du niveau de sécurité, du stockage et du périmètre.

## Critères de validation

Un lot est terminé lorsque :

- le parcours utilisateur fonctionne sur mobile et ordinateur ;
- les états vides, erreurs et confirmations sont traités ;
- les règles métier importantes sont couvertes par des tests ;
- le mode démo n’appelle aucun service externe réel ;
- aucune donnée sensible ne fuit dans les logs, URLs ou outils marketing ;
- le code suit les conventions Maracuja existantes ;
- les migrations sont réversibles et les seeders de démo déterministes ;
- les commandes de test et de vérification pertinentes ont été exécutées ;
- la documentation courte du lot et les variables d’environnement nécessaires sont mises à jour.

## Décisions encore à obtenir de Marcos

Ces questions ne doivent pas bloquer les premiers lots :

- coordonnées définitives, adresse, WhatsApp et règles de disponibilité ;
- parcours professionnel détaillé et vérifiable ;
- établissements liés aux dix années d’enseignement ;
- références et visuels du livre ;
- vidéos choisies et autorisation de publication ;
- exemples de défenses pouvant être publiés et degré d’anonymisation ;
- réservation directe ou proposition manuelle d’un horaire ;
- outil de visioconférence préféré ;
- simple organisation interne des documents ou véritable espace client.

Tant qu’une réponse manque, utiliser un contenu de démonstration clairement remplaçable et ne pas figer le domaine autour d’une hypothèse non validée.
