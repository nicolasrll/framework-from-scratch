<?php

abstract class DefaultController
{
    abstract protected function indexAction($loader);

    protected function renderView($title, $loader, $page)
    {
        global $twig;
        echo $twig->render($page, ['titlePage' => $title]);
    }
}
