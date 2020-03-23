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
        $articles = $articleManager->find();
        echo $articles[0]['title'] . '<br>';
        //$articlesExploded = explode(delimiter, string)

        foreach ($articles as $key => $value) {
                echo $value . '<br>';
        }

        $this->renderView(
            'articles.html.twig',
            [
                $articles
            ]
        );
    }
}
