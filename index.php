
<?php
require 'vendor/autoload.php';

use Core\Dispatcher;
use Core\PdoConnect;
use App\Repository\ArticleManager;
use App\Repository\CommentManager;
use App\Repository\AbstractManager;
use App\Entity\Article;

error_reporting(E_ERROR | E_WARNING | E_PARSE | E_NOTICE);

try {
    define('PROJECT_ROOT_PATH', dirname(__FILE__));

    $dispatcher = new Dispatcher();
    $dispatcher->dispatch();

    $articleManager = new ArticleManager();

    $articleManager->findOne(3);
    $articlesList = $articleManager->findAll();

    $commentManager = new CommentManager();
    $commentManager->findAll();
    $commentManager->findOne(7);

    /**
     * Test de création d'un article
     *
     */
    $article = new Article([
        "title" => "Ipsum lorem",
        "content" => "Ipsum lorem Ipsum lorem Ipsum lorem Ipsum lorem Ipsum lorem Ipsum lorem",
        "date_created" => '2020-02-31 9:12:27',
    ]);
    /**
     *  Doesn't works
     */
    //$articleManager->create($article);



} catch (Exception $e) {
    echo 'Exception reçue : ' . $e->getMessage();
}
