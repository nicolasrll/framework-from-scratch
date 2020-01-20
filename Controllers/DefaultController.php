<?php

abstract class DefaultController
{
    abstract protected function indexAction();

    protected function renderView($title)
    {
        ob_start();
        $titlePage = $title;
        require 'template.php';
        $content = ob_get_clean();
        echo $content;
    }
}
