<?php

namespace App\Controllers;

use Core\DefaultController;
use App\Repository\ArticleManager;
//use App\Repository\CommentManager;
use App\Entity\Article;
use Core\Request;
use Core\Router;

class ArticleformController extends DefaultController
{
    public function indexAction()
    {
        //$articleId = $this->getParams();
        $articleId = $this->callGetParam('id');
        $article = (new ArticleManager())->findOne($articleId);

        $this->renderView(
            'articleform.html.twig',
            [
                'titlePage' => 'Edition d\'un article',
                'article' => $article,
                'idArticle' => $articleId,
                'action' => 'insert'
            ]
        );
    }

    public function editAction()
    {
        //$articleId = $this->getParams();
        $articleId = $this->callGetParam('id');
        $article = (new ArticleManager())->findOne($articleId);

        $this->renderView(
            'articleform.html.twig',
            [
                'titlePage' => 'Edition d\'un article',
                'article' => $article,
                'idArticle' => $articleId,
                'action' => 'edit?id='.$articleId
            ]
        );
    }


    /*
    public function voir()
    {
        $articleId = (Request::getInstance())->getParam('id');

        return $articleId;
    }
    */
}
