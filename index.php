<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<title>Accueil</title>
	</head>
	<body>
		<?php require "_header.php";?>
		<?php require "Controller.php";?>
		<main>
			<h1>Accueil</h1>
			<?php

				$uri = $_SERVER['REQUEST_URI'];
				//$uri = explode('/', $_SERVER['REQUEST_URI']);
				$page = trim(parse_url($uri, PHP_URL_PATH), "/");
				$page = explode('/', $_SERVER['REQUEST_URI']);
				switch($page[1]){
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
			?>
		<?php require "_footer.php"; ?>
	</body>
</html>
