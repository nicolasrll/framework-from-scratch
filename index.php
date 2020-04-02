<?php
require 'vendor/autoload.php';

use Core\Dispatcher;
use Core\PdoConnect;
use App\Repository\ArticleManager;
use App\Repository\CommentManager;
use Core\AbstractManager;
use App\Entity\Article;

//error_reporting(E_ERROR | E_WARNING | E_PARSE | E_NOTICE);

try {
    define('PROJECT_ROOT_PATH', dirname(__FILE__));

    $dispatcher = new Dispatcher();
    $dispatcher->dispatch();

} catch (Exception $e) {
    echo 'Exception reçue : ' . $e->getMessage();
}
