<?php

require_once(PROJECT_ROOT_PATH . '/core/DefaultController.php');

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
        require_once (PROJECT_ROOT_PATH . '/core/Request.php');
        echo (new Request())->getParam('articleId', 'Article');
    }
}
