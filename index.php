<!--<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<title>Accueil</title>
	</head>
	<body>
		<?php require "_header.php";?>
		<main>
			<h1>Accueil</h1>
-->
			<?php
				$uri = $_SERVER['REQUEST_URI'];


				if(isset($uri)){
					$uri = trim(parse_url($uri, PHP_URL_PATH), "/");
					$uri = explode("/", $uri);
				}
				if(isset($uri[0])){
					$controller =  $uri[0];
				}
				require "Controllers/DefaultController.php";
				switch($controller){
					case "accueil":
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
/*
				$title;
			require "_footer.php"; */?>

<!--
		</main>
	</body>
</html>
-->
