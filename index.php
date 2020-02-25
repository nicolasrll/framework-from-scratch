<?php
require 'vendor/autoload.php';

use Core\Dispatcher;

try {
    define('PROJECT_ROOT_PATH', dirname(__FILE__));

    $dispatcher = new Dispatcher();
    $dispatcher->dispatch();
} catch (Exception $e) {
    echo 'Exception reçue : ' . $e->getMessage();
}
