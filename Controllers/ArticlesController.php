<?php

class ArticlesController extends DefaultController
{
    public function indexAction($loader)
    {
        $this->renderView('Articles', $loader, 'articles.html.twig');
    }
}
