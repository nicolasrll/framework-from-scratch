<?php

namespace App\Controllers;

use Core\DefaultController;
use Core\Request;
use Core\PdoConnect;
use App\Repository\ArticleManager;

//use App\Repository\AbstractManager;
//use App\Entity\Article;

class ArticleController extends DefaultController
{
    public function indexAction()
    {
        //$articleManager = new ArticleManager(PdoConnect::getinstance());
        $articleManager = new ArticleManager();
        $articlesList = $articleManager->findAll();
        $this->renderView(
            'article.html.twig',
            [
                'titlePage' => 'Article'
            ]
        );

        //$this->voir();
    }

    public function voirAction()
    {
        require_once (PROJECT_ROOT_PATH . '/core/Request.php');
        $idArticle = (Request::getInstance())->getParam('articleId', 'Article');

        $articleManager = new ArticleManager();
        $article = $articleManager->findOne($idArticle);
    }
}
