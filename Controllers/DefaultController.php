<?php

abstract class DefaultController
{

    abstract protected function indexAction();

    protected function renderView($page)
    {
        require $page.'.php';
    }
}
