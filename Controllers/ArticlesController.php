<?php

class ArticlesController extends DefaultController
{
    public function indexAction()
    {
        $this->renderView(
            'articles.html.twig',
            [
                'titlePage' => 'Articles'
            ]
        );
    }

    public function voirAction()
    {
        require_once './Request.php';
        echo (new Request())->getParam('articlesId', 'Articles');
    }
}
