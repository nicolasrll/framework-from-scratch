<?php

try {
    $uri = $_SERVER['REQUEST_URI'];

    if(isset($uri)){
        $uri = trim(parse_url($uri, PHP_URL_PATH), "/");
        $uri = explode("/", $uri);
        $controllerName =  $uri[0];

        //Si vide on simule une page "Accueil"
        if ('' === $controllerName) {
            $controllerName = 'accueil';
        }
    }

    require "Controllers/DefaultController.php";
    switch($controllerName){
        case 'accueil':
            require "Controllers/AccueilController.php";
            $controller = new AccueilController();
            break;
        case "article":
            require "Controllers/ArticleController.php";
            $controller = new ArticleController();
            break;
        case "articles":
            require "Controllers/ArticlesController.php";
            $controller = new ArticlesController();
            break;
        case "authentification":
            require "Controllers/AuthentificationController.php";
            $controller = new AuthentificationController();
            break;
        default:
            throw new Exception('Aucun controller trouvé.');
    }

    $controller->voirAction();
    $controller->indexAction();

} catch (Exception $e) {
    echo 'Exception reçue : ',  $e->getMessage(), "\n";
}
