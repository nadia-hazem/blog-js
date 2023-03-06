# blog-js

Un blog afin de publier des articles personnels et d’échanger avec
vos visiteurs.
Voici la liste des fonctionnalités :
- Une page d'accueil : Elle contient les derniers articles mis en ligne et quelques
call-to-actions.

- Une page permettant aux utilisateurs de s'authentifier. Sur cette page vous
avec un formulaire de connexion et d'inscription au clic d'un bouton. 
L'inscription doit se faire avec une requête asynchrone et les vérifications
des formulaires doivent être faites en front et en back.

- Une fois inscrit et connecté, vous êtes redirigé vers une page affichant les
informations du profil. L'utilisateur doit pouvoir modifier ses informations et ce
sans rechargement de page.

- Une page qui présente les différents articles du blog. La page présente un
nombre limité d'articles (entre 5 et 20) avec une pagination pour voir les autres
articles. Cette pagination doit se faire avec un paramètre GET dans la requête
(exemple : ?page=1).

- Une page qui permet de créer des articles : La page est accessible uniquement
aux personnes qui possèdent les rôles permettant de rédiger un article
(modérateurs et administrateurs). Chaque article est lié à une catégorie.

- Une page qui affiche le contenu d’un article et les commentaires associés : La
récupération de l’article est gérée via un paramètre dans la requête GET (ex :
?article=1). Cette page est donc une template remplie avec les informations de
l’article correspondant à chaque fois.

- Une page d’administration : Ce panel admin permet aux administrateurs de votre
site de gérer l’ensemble des utilisateurs, articles, commentaires, catégories,
droits, etc.

Toutes les pages doivent présenter un header et un footer contenant les mêmes liens et
ayant les mêmes informations.
