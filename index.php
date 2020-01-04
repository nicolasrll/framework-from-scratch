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
				switch($_GET['page']){
					case "article":
						require "article.php";
						break;
					case "articles":
						require "articles.php";
						break;
					case "authentification":
						require "authentification.php";
						break;
				}
			?>
		</main>
		<?php require "_footer.php"; ?>
	</body>
</html>
