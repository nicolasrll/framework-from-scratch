<?php
	require_once 'vendor/autoload.php';
	$loader = new \Twig\Loader\FilesystemLoader('views/');
	$twig = new \Twig\Environment($loader);


	$uri = $_SERVER['REQUEST_URI'];

	if(isset($uri)){
		$uri = trim(parse_url($uri, PHP_URL_PATH), "/");
		$uri = explode("/", $uri);
		$controller =  $uri[0];
	}

	require "Controllers/DefaultController.php";
	switch($controller){
		case "":
			require "Controllers/AccueilController.php";
			$accueilController = new AccueilController();
			$accueilController->indexAction($loader);
			break;
		case "article":
			require "Controllers/ArticleController.php";
			$articleController = new ArticleController();
			$articleController->indexAction($loader);
			break;
		case "articles":
			require "Controllers/ArticlesController.php";
			$articlesController = new ArticlesController();
			$articlesController->indexAction($loader);
			break;
		case "authentification":
			require "Controllers/AuthentificationController.php";
			$authentificationController = new AuthentificationController();
			$authentificationController->indexAction($loader);
			break;
	}
