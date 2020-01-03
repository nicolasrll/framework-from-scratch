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
				switch($_GET['page']){
					case "accueil":
						$content = require "accueil.php";
						break;
					case "article":
						$content = require "article.php";
						
						break;
					case "articles":
						$content = require"articles.php";
						break;
					case "authentification":
						$content = require "authentification.php";
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