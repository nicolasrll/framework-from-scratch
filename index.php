<?php
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
			$accueilController->indexAction();
			break;
		case "article":
			require "Controllers/ArticleController.php";
			$articleController = new ArticleController();
			$articleController->indexAction();
			break;
		case "articles":
			require "Controllers/ArticlesController.php";
			$articlesController = new ArticlesController();
			$articlesController->indexAction();
			break;
		case "authentification":
			require "Controllers/AuthentificationController.php";
			$authentificationController = new AuthentificationController();
			$authentificationController->indexAction();
			break;
	}
