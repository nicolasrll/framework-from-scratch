<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<title>Accueil</title>
	</head>

	<body>
		<?php require "_header.php"; ?>
		
		<main>
			<?php
				function index(){
					$content = require "accueil.php";
				}
				function article(){
					$content = require "article.php";
				}
				function articles(){
					$content = require"articles.php";
				}
				function authentification(){
					$content = require "authentification.php";
				}
				switch($_GET['page']){
					case "accueil":
						index();
						break;
					case "article":
						article();
						break;
					case "articles":
						articles();
						break;
					case "authentification":
						authentification();
						break;
				}

				$content;
				$uri = $_SERVER['REQUEST_URI'];
				$uri_trim = trim(parse_url($uri, PHP_URL_PATH), "/");	
			?>
			</main>

		<?php require "_footer.php"; ?>
	</body>

</html> 