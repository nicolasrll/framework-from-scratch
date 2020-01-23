<?php

abstract class DefaultController
{
    abstract protected function indexAction();

    protected function renderView($titlePage)
    {
        ob_start();
        require 'template.php';
        echo ob_get_clean();
    }
}
