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
				if(empty($uri[0])){
					$controller =  $uri[0];
				}
				switch($controller){
					case "accueil":
						require "Controllers/AccueilController.php";
						$accueilController = new AccueilController();
						$accueilController->index();
						break;
					case "article":
						require "Controllers/ArticleController.php";
						$articleController = new ArticleController();
						$articleController->index();
						break;
					case "articles":
						require "Controllers/ArticlesController.php";
						$articlesController = new ArticlesController();
						$articlesController->index();
						break;
					case "authentification":
						require "Controllers/AuthentificationController.php";
						$authentificationController = new AuthentificationController();
						$authentificationController->index();
						break;
				}
			require "_footer.php"; ?>
		</main>
	</body>
</html>
