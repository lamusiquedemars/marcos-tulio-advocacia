# Recette bout en bout — Agendamento avec Brevo Meetings

## Objectif

Valider qu'un visiteur peut partir du site, réserver un rendez-vous dans Brevo
Meetings, recevoir les bons emails et retrouver le rendez-vous dans les outils
du cabinet, sans transmettre à Brevo le récit juridique du dossier.

## Préconditions

- utiliser une adresse email de recette réellement consultable ;
- créer dans Brevo un type de rendez-vous dédié, par exemple
  `RECETTE — Consultation initiale`, facilement supprimable ;
- limiter temporairement les disponibilités à un créneau de recette ;
- vérifier le fuseau professionnel `America/Cuiaba` ;
- connecter l'agenda de test attendu dans Brevo ;
- copier le lien public du type de rendez-vous Brevo ;
- désactiver le mode démonstration du site uniquement dans l'environnement de
  recette ;
- configurer le module du site en mode `direct`, fournisseur `brevo`, avec le
  lien public copié ;
- ne saisir aucune donnée réelle ou sensible dans les champs de recette.

## Données de test

| Champ | Valeur |
|---|---|
| Prénom | Recette |
| Nom | Agendamento |
| Email | `<ADRESSE_DE_RECETTE>` |
| Téléphone | un numéro fictif réservé aux tests, ou aucun |
| Type | `RECETTE — Consultation initiale` |
| Créneau | `<DATE_ET_HEURE>` |
| Fuseau visiteur | `<FUSEAU_AFFICHÉ_PAR_LE_NAVIGATEUR>` |
| Notes | `RECETTE E2E — aucune donnée juridique réelle` |

## Cas nominal E2E-AGD-001

1. Ouvrir la page `/contact` dans une fenêtre privée.
2. Vérifier la présence de `Agendamento direto disponível` et du bouton
   `Ver horários disponíveis`.
3. Cliquer sur le bouton.
4. Vérifier que `/agendamento` s'affiche sans erreur 503 et que l'interface de
   réservation est en portugais.
5. Vérifier le type de rendez-vous, la durée, le fuseau et les créneaux.
6. Choisir le créneau de recette.
7. Saisir uniquement les données de test ci-dessus et confirmer.
8. Capturer la page de confirmation et son heure d'affichage.
9. Dans Brevo, vérifier :
   - la présence du rendez-vous dans `Conversations > Meetings` ;
   - le bon type, la bonne date, la durée et le fuseau ;
   - la création ou mise à jour du contact de recette ;
   - l'absence du récit juridique de la demande ;
   - le statut et, si disponible, l'identifiant du rendez-vous.
10. Dans l'agenda connecté, vérifier :
    - la présence d'un seul événement ;
    - la date, l'heure, la durée et le fuseau ;
    - le lien de visioconférence ou le lieu attendu.
11. Dans la boîte de recette, vérifier :
    - la réception de la confirmation ;
    - l'expéditeur, l'objet, la langue et les horaires ;
    - le lien d'ajout à l'agenda ou de visioconférence ;
    - les liens de modification et d'annulation ;
    - l'absence de données sensibles inattendues.
12. Dans les journaux ou événements Brevo, relever les états disponibles de
    l'email, notamment `sent` et `delivered`.

## Annulation E2E-AGD-002

1. Depuis l'email reçu, ouvrir le lien d'annulation.
2. Annuler le rendez-vous.
3. Vérifier la confirmation dans le navigateur.
4. Vérifier le statut annulé dans Brevo.
5. Vérifier la suppression ou l'annulation de l'événement dans l'agenda.
6. Vérifier la réception de l'email d'annulation.
7. Vérifier que le créneau redevient disponible.

## Résultats à consigner

| Contrôle | Attendu | Obtenu | Preuve | Statut |
|---|---|---|---|---|
| Départ depuis `/contact` | bouton visible |  | capture/URL | À faire |
| Page `/agendamento` | interface Brevo en portugais |  | capture | À faire |
| Confirmation navigateur | réservation confirmée |  | capture | À faire |
| Brevo Meetings | rendez-vous unique |  | capture/ID | À faire |
| Contact Brevo | contact de recette présent |  | capture/ID | À faire |
| Agenda connecté | événement unique et correct |  | capture | À faire |
| Email de confirmation | reçu et conforme |  | capture/en-têtes | À faire |
| Annulation | propagée partout |  | captures | À faire |

## Critères d'acceptation

La recette est acceptée si tous les contrôles sont conformes, si les horaires
sont cohérents entre le navigateur, Brevo et l'agenda, si les emails sont reçus
et si aucune donnée juridique sensible n'est transmise à Brevo.

Tout écart doit préciser l'heure, le fuseau, l'URL ou l'identifiant concerné,
une capture et l'étape exacte de reproduction.

## Nettoyage

- annuler le rendez-vous de recette ;
- supprimer le contact de recette dans Brevo si sa conservation n'est pas utile ;
- supprimer le créneau et le type de rendez-vous temporaires ;
- remettre la configuration de l'environnement dans son état initial ;
- ne pas supprimer les preuves avant la clôture de la recette.

## État technique constaté le 28 juillet 2026

- les tests fonctionnels existants couvrent uniquement le fournisseur factice ;
- le mode démonstration est actif localement et dans l'exemple de production ;
- l'envoi email applicatif est configuré sur le transport `log` ;
- le contrôleur `/agendamento` renvoie volontairement une erreur 503 lorsque le
  fournisseur est `brevo` ;
- aucun traitement de webhook Meetings (`booked`, `started`, `cancelled`) n'est
  encore présent dans le module Appointments.

Ces points empêchent actuellement de déclarer le parcours réel validé depuis le
site jusqu'à Brevo.
