<?php

class ArticlesController extends DefaultController
{
    public function indexAction()
    {
        $this->renderView('Articles');
    }
}
