<?php
try {
    require_once('core/Request.php');
    require_once('core/Router.php');
    require_once('core/Dispatcher.php');

    $request = new Request();

    $router = new Router($request);

    $dispatcher = new Dispatcher($router);
    $dispatcher->dispatch();
} catch (Exception $e) {
    echo 'Exception reçue : ' . $e->getMessage();
}
