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
    }

    public function voirAction()
    {
        require_once './Request.php';
        $request = new Request();
        $articleId = $request->getParam('articleId');
        echo $articleId;
    }
}
