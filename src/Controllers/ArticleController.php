<?php

namespace App\Controllers;


use Core\DefaultController;
use Core\Request;

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
        echo (Request::getInstance())->getParam('articleId', 'Article');
    }
}
