<?php

abstract class DefaultController
{
    abstract protected function indexAction();

    protected function renderView($view, array $params = [])
    {
        global $twig;

        echo $twig->render($view, $params);
    }
}
