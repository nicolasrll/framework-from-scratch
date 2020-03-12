<?php

namespace App\Controllers;

use Core\DefaultController;
use Core\Request;
use Core\PdoConnect;
use App\Repository\ArticleManager;
use App\Repository\CommentManager;
use App\Entity\Article;
use App\Entity\Comment;

//use App\Repository\AbstractManager;
//use App\Entity\Article;

class ArticleController extends DefaultController
{
    public function indexAction()
    {
        //$articleManager = new ArticleManager(PdoConnect::getinstance());
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
        $commentManager = new CommentManager();
        //$article = $articleManager->findOne($idArticle);
        //$articleManager->find($idArticle));
        //echo '<br><br>';
        //$commentManager->find(['article_id' => $idArticle]));
    }

    public function saveAction()
    {
        $postData = [
	        'id' => 20,
	        'title' => 'Blabla',
	        'content' => 'L\Aerty ressemble au qwerty',
        ];
        $article = (new Article())
	        ->hydrate($postData);

        $result = (new ArticleManager())->insert($article);
        var_dump($result);
    }
}
