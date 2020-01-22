<?php

abstract class DefaultController
{
    abstract protected function indexAction($loader);

    protected function renderView($title, $loader)
    {
        $twig = new \Twig\Environment($loader);
        $template = $twig->load('template.php');
        echo $template->render(['titlePage' => $title]);
    }
}
