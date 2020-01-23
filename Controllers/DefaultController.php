<?php

abstract class DefaultController
{
    abstract protected function indexAction($loader);

    protected function renderView($title, $loader)
    {
        global $twig;
        echo $twig->render('template.php', ['titlePage' => $title]);
    }
}
