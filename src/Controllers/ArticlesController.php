<?php

namespace App\Controllers;

use Core\DefaultController;
use App\Repository\ArticleManager;
//use App\Repository\CommentManager;
use App\Entity\Article;

class ArticlesController extends DefaultController
{
    public function indexAction()
    {
        $articleManager = new ArticleManager();
        //$articleManager->find());
        $this->renderView(
            'articles.html.twig',
            [
                'titlePage' => 'Articles'
            ]
        );
    }
}
