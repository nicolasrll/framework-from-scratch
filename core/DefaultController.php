<?php

namespace Core;

use Twig\Loader\FilesystemLoader;
use Twig\Environment;

abstract class DefaultController
{
    abstract protected function indexAction();

    protected function renderView(string $view, array $params = [])
    {
        require_once 'vendor/autoload.php';

        $loader = new FilesystemLoader('template/');
        $twig = new Environment($loader);

        echo $twig->render($view, $params);
    }

/*
    public function getParams()
    {
        $articleId = (Request::getInstance())->getParam('id');

        return $articleId;
    }
*/

    public function callGetParam($searching)
    {
        return (Request::getInstance())->getParam($searching);
    }
}

