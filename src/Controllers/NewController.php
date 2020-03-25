<?php

namespace App\Controllers;

use Core\DefaultController;
use App\Repository\ArticleManager;
//use App\Repository\CommentManager;
use App\Entity\Article;
use Core\Request;
use Core\Router;

class NewController extends DefaultController
{
    public function indexAction()
    {
        $idArticle = $this->voir();

        $article = (new ArticleManager())->find($idArticle);

        $this->renderView(
            'new.html.twig',
            [
                'titlePage' => 'Articles',
                'article' => $article,
                'idArticle' => $idArticle
            ]
        );
    }

    public function voir()
    {
        require_once (PROJECT_ROOT_PATH . '/core/Request.php');
        $idArticle = (Request::getInstance())->getParam('articleId', 'Article');

        return $idArticle;
    }
}
