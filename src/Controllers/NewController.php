<?php

namespace App\Controllers;

use Core\DefaultController;
use App\Repository\ArticleManager;
//use App\Repository\CommentManager;
use App\Entity\Article;

class NewController extends DefaultController
{
    public function indexAction()
    {
        $this->renderView(
            'new.html.twig',
            [
                'titlePage' => 'Articles'
            ]
        );
    }
}
