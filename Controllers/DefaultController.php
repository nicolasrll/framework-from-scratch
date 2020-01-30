<?php

abstract class DefaultController
{
    abstract protected function indexAction();

    protected function renderView($view, array $params = [])
    {
        require_once 'vendor/autoload.php';
        $loader = new \Twig\Loader\FilesystemLoader('views/');
        $twig = new \Twig\Environment($loader);
        $twig;

        echo $twig->render($view, $params);
    }
}
