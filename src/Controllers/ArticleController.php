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
        $articleManager = new ArticleManager();
        $commentManager = new CommentManager();
        $idArticle = $this->voir();
        $article = $articleManager->find($idArticle);

        $comments = $commentManager->find(['article_id' => $idArticle]);
        $this->renderView(
            'article.html.twig',
            [
                'titlePage' => 'Article',
                'article' => $article,
                'comments' => $comments,
                'idArticle' => $idArticle
            ]
        );
    }

    public function voir()
    {
        //require_once (PROJECT_ROOT_PATH . '/core/Request.php');
        $idArticle = (Request::getInstance())->getParam('articleId', 'Article');

        return $idArticle;
    }

    public function addAction()
    {
        $article = (new Article())->hydrate($_POST['article']);
        $result = (new ArticleManager())->add($article);


        $articleManager = new ArticleManager();
        $articles = $articleManager->find();
        $this->renderView(
            'articles.html.twig',
            [
                'articles' => $articles
            ]
        );
    }

    public function updateAction()
    {
        // On récupère l'article déjà existant via un get ici qu'on simule avec un new Article en brut
        // On instant ArticleManager
        // Puis on appelle la méthode update
        $idArticle = $this->voir();
        $entity = (new Article())->hydrate($_POST['article']);
        //$articleManager = (new ArticleManager())->save($entity);;
        $articleManager = (new ArticleManager())->update($entity, $idArticle);

        $articleManager = new ArticleManager();
        $commentManager = new CommentManager();
        $article = $articleManager->find($idArticle);
        $comments = $commentManager->find(['article_id' => $idArticle]);
        $this->renderView(
            'article.html.twig',
            [
                'titlePage' => 'Article',
                'article' => $article,
                'comments' => $comments,
                'idArticle' => $idArticle
            ]
        );
    }
}
