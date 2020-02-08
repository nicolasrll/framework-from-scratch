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
        $request = new Request();
        $articles = $request->getParam('articlesId');
        echo $articles;
    }
}
