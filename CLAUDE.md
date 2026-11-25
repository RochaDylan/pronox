# Pronox – Contexte du projet

## Le projet
- **Pronox** : application web de pronostics de football, 100 % ludique (pas d'argent, pas de mise en ligne).
- Projet de **TPI** (CFC informaticien, CEFF) de **Dylan Rocha**.
- Échéance du POC1 : **23 décembre 2026**.
- **POC1** = espace admin d'abord, puis matchs, pronostics, système de points, utilisateurs.
- Plus tard (hors POC1) : signalements, blocage de comptes, délégation admin, thème clair.

## Règles pour l'assistant (important)
- **Dylan écrit le code lui-même** pour se préparer au TPI. L'assistant **explique et donne des exemples**, il ne réécrit pas tout le projet sans qu'on le demande.
- Le code doit rester **simple** et **défendable devant les experts** : pas d'abstraction inutile, pas de patterns avancés.
- Dylan n'aime pas les `if` répétés : utiliser une **map** (tableau associatif / objet) à la place.
- Explications en **français**, courtes, avec une phrase « à dire aux experts » si c'est utile.

## Stack
- Laravel 13 + Inertia + Vue 3 (starter kit Vue : Fortify, TypeScript, Tailwind)
- SQLite
- Pest pour les tests
- API-Football (synchronisation des matchs, pas encore faite)
- Ziggy : `route()` disponible côté Vue
- Icônes : lucide-vue-next (**attention** : Lucide exporte aussi une icône `Link`, toujours importer `Link` depuis `@inertiajs/vue3`)
- Développement sous Windows, dans VS Code

## Barème des points
- Score exact : 4 pts
- Bons buts à domicile : 2 pts
- Bons buts à l'extérieur : 2 pts
- Bonne différence de buts : 2 pts
- Cumulatif, donc un score exact = **10 pts**
- Score à la fin du temps réglementaire (90 min), pronostic verrouillé au coup d'envoi.

## Base de données
Tables : `competitions`, `games`, `predictions`, `users`, `groups`, `group_user`.

```
competitions : id, api_id (unique), name
games        : id, api_id (unique), competition_id, home_team, away_team,
               home_team_logo, away_team_logo, status, kickoff_at, home_score, away_score
predictions  : id, user_id, game_id, home_score, away_score, points
users        : id, name (unique), email (unique), password, role, points
groups       : id, name, description, visibility, invite_code (unique), competition_id, created_by
group_user   : id, group_id, user_id, role, points, joined_at
```
- Contraintes uniques : (user_id, game_id) dans predictions, (group_id, user_id) dans group_user.
- `games.status` : scheduled, live, finished, postponed, cancelled.
- Dates stockées en **UTC**, affichées en `Europe/Zurich`.
- Les points sont stockés dans predictions, users et group_user : en cas de correction d'un score, il faudra **retirer les anciens points avant d'ajouter les nouveaux**.

## Ce qui est fait
- Figma (maquettes mobile, espace admin avec prototype), schéma Mermaid, planning Excel, journal de travail.
- Migrations et modèles avec relations.
- Factories et seeders : `GameFactory` avec les états `finished()`, `withoutScore()`, `postponed()`, `today()`, `live()`, `cancelled()`.
- Logo et favicon installés, page `Welcome.vue` (logo + bouton « Commencer »).
- Séparation admin / joueur :
  - colonne `role` sur users
  - Gates `admin` et `player`
  - la route `/dashboard` redirige vers `admin.dashboard` ou `user.dashboard`
  - `routes/admin.php` : middleware `['auth', 'verified', 'can:admin']`, prefix `admin`, name `admin.`
- `Admin/DashboardController` + `pages/Admin/Dashboard.vue` (carte « À traiter » : matchs sans score et matchs reportés, tuiles vers Utilisateurs, Matchs et Groupes, bouton de déconnexion).
- `Admin/GameController` :
  - `index()` : filtres avec une **map de fonctions** (`upcoming`, `today`, `finished`, `missing`, `postponed`) + recherche par équipe dans un `where(function ...)` imbriqué pour que le `OR` ne casse pas le filtre.
  - `updateScore()` : valide `home_score` et `away_score`, passe le match en `finished`, `return back()`.
  - Route : `Route::patch('/games/{game}/score', [GameController::class, 'updateScore'])->name('games.score');`
- Vue :
  - `components/admin/FilterTabs.vue` : onglets de filtre réutilisables (props `tabs`, `active`, `routeName`, `params`).
  - `components/admin/GameCard.vue` : un seul fichier, badge du statut via une map, date en heure suisse, saisie du score avec `useForm` + `form.patch(route('admin.games.score', id))`.
  - `pages/Admin/Games.vue` : onglets + recherche + liste de GameCard.

## À vérifier
- La **déconnexion** : doit être uniquement `<Link :href="route('logout')" method="post" as="button">`, sans `@click` en plus (sinon double envoi → erreur 419).

## Prochaines étapes
1. Pages admin `Users.vue` et `Groups.vue` (réutiliser `FilterTabs`).
2. Calcul des points dans `updateScore` (avec retrait des anciens points en cas de correction).
3. Synchronisation API-Football (commande artisan + planification).
4. Pages joueur : matchs, pronostics, groupes, classements.
5. Tests Pest.

## Design
- Couleurs : fond `#0A0A0A`, surface `#131313`, surface 2 `#1F1F1F`, bordure `#262626`, contour des filtres `#2E2E2E`, texte `#F2F2F2`, texte secondaire `#8C8C8C` / `#C4C4C4`, accent `#C8F25C`, alerte `#FF8A3D`.
- Polices : **Barlow Condensed** (texte) et **Doto** (chiffres, titres). Doto n'a pas de É majuscule : utiliser Barlow pour les textes accentués en majuscules.
- Tailwind : écrire `font-[Barlow_Condensed]` (underscore à la place de l'espace).
- Format mobile en priorité.
