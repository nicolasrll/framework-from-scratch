<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<title>Accueil</title>
	</head>
	<body>
		<?php require "_header.php";?>
		<main>
			<h1>Accueil</h1>
			<?php
				$uri = $_SERVER['REQUEST_URI'];
				$uri = trim(parse_url($uri, PHP_URL_PATH), "/");
				$uri = explode("/", $uri);
				$controller =  $uri[0];
				$action = $uri[1];
				switch($controller){
					case "accueil":
						require "Controllers/AccueilController.php";
						$accueilController = new AccueilController;
						switch($action){
							case 'see':
								$accueilController->see();
								break;
							/*
							case 'delete':
								$accueilController->delete();
								break;
							*/
						}
						break;
					case "article":
						require "Controllers/ArticleController.php";
						$articleController = new ArticleController;
						switch($action){
							case 'see':
								$articleController->see();
								break;
							/*
							case 'delete':
								$articleController->delete();
								break;
							*/
						}
						break;
					case "articles":
						require "Controllers/ArticlesController.php";
						$articlesController = new ArticlesController;
						switch($action){
							case 'see':
								$articlesController->see();
								break;
							/*
							case 'delete':
								$articlesController->delete();
								break;
							*/
						}
						break;
					case "authentification":
						require "Controllers/AuthentificationController.php";
						$AuthentificationController = new AuthentificationController;
						switch($action){
							case 'see':
								$AuthentificationController->see();
								break;
							/*
							case 'delete':
								$AuthentificationController->delete();
								break;
							*/
						}
						break;
				}
			require "_footer.php"; ?>
		</main>
	</body>
</html>
