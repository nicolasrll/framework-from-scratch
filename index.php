<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<title>Accueil</title>
	</head>
	<body>
		<?php require "_header.php"; ?>
		<main>
			<h1>Accueil</h1>
			<?php

				$uri = $_SERVER['REQUEST_URI'];
				$page = trim(parse_url($uri, PHP_URL_PATH), "/");
			<?php
				switch($page]){
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
		<?php require "_footer.php"; ?>
	</body>
</html>
