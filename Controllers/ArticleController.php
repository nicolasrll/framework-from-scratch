<?php

class ArticleController extends DefaultController
{
    public function indexAction($loader)
    {
        $this->renderView('Article', $loader);
    }
}
