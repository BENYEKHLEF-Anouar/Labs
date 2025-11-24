# Vite
## Qu’est-ce que Vite ?
Vite est un outil de développement front-end qui permet de créer des sites et applications web très rapidement.

## Pourquoi les développeurs l’utilisent ?
Les grosses applications JavaScript mettent souvent du temps à démarrer ou à se recharger pendant le développement.
Vite rend tout beaucoup plus rapide.

## Comment ça fonctionne ?
Vite contient deux parties principales :

1. Un serveur de développement ultra rapide

Au lieu de tout “bundler” dès le lancement, Vite utilise les modules ES natifs du navigateur.

Le navigateur charge uniquement les fichiers nécessaires.

Résultat : démarrage instantané et HMR super rapide (la page se met à jour en quelques millisecondes quand tu modifies un fichier).

2. Un outil de build pour la production

Quand tu veux publier ton projet, Vite utilise Rollup.

Ça optimise, compresse et regroupe tout ton code pour qu’il soit rapide à charger.






---------------
* ``Bundling`` est le processus de combinaison de plusieurs fichiers (comme JavaScript, CSS ou d'autres ressources) en un seul fichier ou en quelques fichiers. Les bundlers peuvent minifier (réduire) le code, supprimer les parties inutilisées et améliorer les performances.

* ``Les modules ES natifs`` sont la norme officielle pour le packaging du code JavaScript, introduite avec ES6, qui permet aux développeurs d'importer et d'exporter des fonctionnalités entre fichiers. Ils sont pris en charge nativement par les navigateurs modernes et ont été adoptés par Node.js, ce qui permet de les utiliser sans outils de compilation. Les principaux avantages incluent une syntaxe claire, une analyse statique pour une meilleure optimisation et une organisation du code améliorée.

* ``Rollup`` est un outil de regroupement de modules JavaScript. Autrement dit, il prend plusieurs fichiers JavaScript (modules) et les combine en un seul fichier (ou quelques fichiers) que les navigateurs peuvent charger efficacement.

* ``PostCSS`` is a tool that transforms CSS using JavaScript plugins.

* ``Autoprefixer`` is a tool that automatically adds vendor prefixes to CSS rules, making sure your modern CSS is compatible with different web browsers.