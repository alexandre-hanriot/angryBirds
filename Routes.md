# Les routes de l'appli

|URL|Contrôleur|Méthode|Paramètres|Description|
|-|-|-|-|-|
|/|MainController|index()|-|Liste des oiseaux|
|/bird/{id}|MainController|birdShow()|Identifiant de l'oiseau|Détail d'un oiseau|
|/download|MainController|download()|-|Télécharger le calendrier|
|/api/birds|ApiController|getBirds()|-|Retourne le JSON des oiseaux
|||||Lien vers dernier oiseau vu (même lien que bird show ?)