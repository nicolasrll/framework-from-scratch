<?php

class ArticleController extends DefaultController
{
    public function indexAction()
    {
        $this->renderView(
            'article.html.twig',
            [
                'titlePage' => 'Article'
            ]
        );

        //$this->voir();
    }

    public function voir()
    {
        require_once './Request.php';
        echo (new Request())->getParam('articleId', 'Article');
    }
}
