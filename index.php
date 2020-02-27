<?php
require 'vendor/autoload.php';

use Core\Dispatcher;

try {
    define('PROJECT_ROOT_PATH', dirname(__FILE__));

    $dispatcher = new Dispatcher();
    $dispatcher->dispatch();

    $db = new PDO('mysql:host=localhost;dbname=framework-from-scratch', 'nicolas', 'Diabolo206!');

    $article = new ArticleController([
        'name' => 'Intégrer un thème Wordpress',
        'name_author' => 'Nicolas Rellier',
        'date_update' => NOW(),
        'chapo' => 'Chalet & Caviar est une agence immobilière de luxe',
        'content' => 'Ici sera présent le contenu',
        'url_project' => 'https://github.com/nicolasrll/'
    ]);

    $articleManager = new ArticleManager($db);

} catch (Exception $e) {
    echo 'Exception reçue : ' . $e->getMessage();
}
