<?php

abstract class DefaultController
{
    abstract protected function indexAction();

    protected function renderView($title)
    {
        ob_start();
        $titlePage = $title;
        require 'template.php';
        echo ob_get_clean();
    }
}
