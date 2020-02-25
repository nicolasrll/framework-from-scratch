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
        require_once (PROJECT_ROOT_PATH . '/core/Request.php');
        echo (Request::getInstance())->getParam('articleId', 'Article');
    }
}
