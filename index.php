<?php
try {
    require_once('core/Request.php');
    require_once('core/Router.php');
    require_once('core/Dispatcher.php');

    define('PROJECT_ROOT_PATH', dirname(__FILE__));

    $dispatcher = new Dispatcher();
    $dispatcher->dispatch();
} catch (Exception $e) {
    echo 'Exception reçue : ' . $e->getMessage();
}
