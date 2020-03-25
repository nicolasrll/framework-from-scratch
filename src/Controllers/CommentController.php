<?php

namespace App\Controllers;

use Core\DefaultController;
use Core\Request;
use Core\PdoConnect;
use App\Repository\ArticleManager;
use App\Repository\CommentManager;
use App\Entity\Article;
use App\Entity\Comment;


class CommentController extends DefaultController
{
    public function indexAction()
    {
        $articleManager = new ArticleManager();
        $commentManager = new CommentManager();
        //$article = $articleManager->findOne($idArticle);

        $idComment = $this->voir();

        $comment = $commentManager->find($idComment);

        $article = $articleManager->find($comment['article_id']);
        echo '<br><h1>Commentaire de l\'article</h1>';
        $comments = $commentManager->find(['article_id' => $comment['article_id']]);
        //$comment = $commentManager->find($idComment);
        $this->renderView(
            'article.html.twig',
            [
                'titlePage' => 'Accueil',
                'titleArticle' => $article['title'],
                'contentArticle' => $article['content'],
                'comments' => $comments,
                'comment' => $comment
            ]
        );

    }

    public function voir()
    {
        require_once (PROJECT_ROOT_PATH . '/core/Request.php');
        $idArticle = (Request::getInstance())->getParam('commentId', 'Article');

        return $idArticle;
    }


    public function addAction()
    {
        $entity = (new Comment())->hydrate($_POST['comment']);
        $commentManager = (new CommentManager())->add($entity);
        //$commentManager->add($entity);
    }

    public function updateAction()
    {
        // On récupère l'article déjà existant via un get ici qu'on simule avec un new Article en brut
        // On instant ArticleManager
        // Puis on appelle la méthode update
        $idArticle = $this->voir();
        //$entity = (new Comment())->hydrate($postData);
        $entity = (new Comment())->hydrate($_POST['comment']);
        //$articleManager = (new ArticleManager())->save($entity);;
        $articleManager = (new CommentManager())->update($entity, $idArticle);
    }
}
