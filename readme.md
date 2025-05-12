# 🎬 AluileCiné — Mini-projet PHP

Bienvenue sur **AluileCiné**, un site web de critiques de films et séries réalisé dans le cadre d’un mini-projet PHP.  
Il permet aux utilisateurs de consulter, ajouter, modifier et supprimer des critiques — comme sur Allociné !

---

## 🚀 Fonctionnalités

- 🔍 Affichage de toutes les critiques existantes sous forme de cartes (2 par ligne)
- ⭐ Note de 1 à 4 étoiles attribuée à chaque film ou série
- ✏️ Formulaire d’ajout ou de modification de critique
- ❌ Suppression avec confirmation (popup)
- ⚙️ Stockage des données dans un fichier texte (`data.txt`)
- 📱 Design responsive avec W3.CSS (PC, tablette, mobile)
- 🔄 Filtrage dynamique par note (en JavaScript)
- 📦 Architecture simple en PHP (pas de base MySQL)
-    Ajout du Bonus inspiré de allo ciné 

### ⚙️ Environnement

Le site est entièrement développé en PHP, HTML, CSS et JavaScript, conformément aux consignes du projet.  
Docker est utilisé uniquement comme **outil de développement local**, afin de lancer facilement un serveur PHP/Nginx/MySQL via les scripts `start.bash` et `stop.bash`.  
Aucun autre langage n'est utilisé pour les fonctionnalités du site.

## 📝 Remarque : 

- Toutes les fonctionnalités du site ont été développées en HTML, CSS, JavaScript et PHP, conformément aux consignes du projet.
Les critiques sont enregistrées dans un fichier texte data.txt, simulant une base de données, sans utiliser MySQL.
Docker et les scripts Bash (start.bash, stop.bash) mon uniquement servi à créer un environnement de développement local, sans impact sur le fonctionnement du site.

## Accès local :

- Pour tester le projet en local, vous pouvez utiliser les scripts start.bash et stop.bash (nécessite Docker installé).
- Ensuite, accédez au site via http://localhost:8080 dans votre navigateur.

Auteur : Vic
Auteur du script bash: Ardou
