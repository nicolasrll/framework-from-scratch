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
			?>
		</main>

		<?php require "_footer.php"; ?>
	</body>

</html> 