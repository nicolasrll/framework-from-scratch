<?php
require 'vendor/autoload.php';

use Core\Dispatcher;
use Core\PdoConnect;
use App\Repository\ArticleManager;
use App\Repository\CommentManager;
use Core\AbstractManager;
use App\Entity\Article;

error_reporting(E_ERROR | E_WARNING | E_PARSE | E_NOTICE);

try {
    define('PROJECT_ROOT_PATH', dirname(__FILE__));

    $dispatcher = new Dispatcher();
    $dispatcher->dispatch();

    $articleManager = new ArticleManager();
    //$articlesList = $articleManager->findOne(3);
    //$articlesList = $articleManager->findAll();


    $commentManager = new CommentManager();
    //$commentList = $commentManager->findAll();
    //$commentList = $commentManager->find();
    //$commentList = $commentManager->findOne(7);
    //echo '<br><br>Résultat<br>';

/*
    $article = [
        'title' => 'L\'origine du loremp ipsum',
        'content' => 'Ipsum lorem Ipsum lorem Ipsum lorem Ipsum lorem Ipsum lorem Ipsum lorem',
    ];

    $comment = [
        'article_id' => 6,
        'pseudo' => 'Toto',
        'comment' => 'nice!'
    ];
*/

    //$articleManager->add($article);
    //$commentManager->save($comment);
    /*
    $pdo = PdoConnect::getInstance();

    $request = $pdo->prepare('INSERT INTO Article (title, content, date_created) VALUES (:title, :content, :date_created)');
        echo '<br><br>';

    //$request->bindValue(':id', 12);
    $request->bindValue(':title', 'Un test à la main');
    $request->bindValue(':content', 'Ce travail de création a été réalisé depuis la page index');
    $request->bindValue(':date_created', '2020/03/09 14:21:38');
    $request->execute();
    */

} catch (Exception $e) {
    echo 'Exception reçue : ' . $e->getMessage();
}
