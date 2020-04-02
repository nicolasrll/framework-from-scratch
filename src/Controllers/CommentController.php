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

        //$commentId = $this->getParams();
        $commentId = $this->callGetParam('id');

        $comment = $commentManager->findOne($commentId);

        $article = $articleManager->findOne($comment->getArticleId());

        $comments = $commentManager->find(['article_id' => $comment->getArticleId()]);
        $comment = $commentManager->findOne($commentId);

        $this->renderView(
            'comment.html.twig',
            [
                'titlePage' => 'Modification du commentaire',
                'article' => $article,
                //'comments' => $comments,$
                'comment' => $comment,
                //'idArticle' => $comment->getArticle_Id()
                'action' => 'edit?id='. $comment->getId(),
                'actionArticle' => 'edit'
            ]
        );


        /*
        $this->renderView(
            'article.html.twig',
            [
                'titlePage' => 'Accueil',
                'article' => $article,
                'comments' => $comments,
                'comment' => $comment
            ]
        );
        */

    }

/*
    public function voir()
    {
        $articleId = (Request::getInstance())->getParam('id');

        return $articleId;
    }
*/

    public function insertAction()
    {
        $entity = (new Comment())->hydrate($this->callGetParam('comment'));

        $commentManager = (new CommentManager())->insert($entity);

        $articles = (new ArticleManager())->find();
        $this->renderView(
            'articles.html.twig',
            [
                'articles' => $articles,
                'message' => 'L\'article a bien été supprimé'
            ]
        );

    }

    public function editAction()
    {
        //$commentId = (Request::getInstance())->getParam('id');
        $commentId = $this->callGetParam('id');

        $commentManager = new CommentManager();
        // Retrive the item to update it
        $comment = $commentManager->findOne($commentId);

        if (!$comment) {
            throw new \Exception('Le commentaire que vous souhaitez mettre jour n\'est plus disponible');
        }


        //$entity = (new Comment())->hydrate($_POST['comment']);
        // Commenter le temps de résoudre mon problème
        //$entity = $comment->hydrate((Request::getInstance())->getParam('comment'));
        $entity = $comment->hydrate($this->callGetParam('comment'));
        //$entity->setId($commentId);

        $commentEdited = $commentManager->edit($entity);

        $articleManager = new ArticleManager();
        // On récupère l'article
        $article = $articleManager->findOne($comment->getArticleId());
        // On récupère tous les article associé à l'article
        $comments = $commentManager->find(['article_id' => $comment->getArticleId()]);

        if (!$commentEdited) {
        $this->renderView(
            'comment.html.twig',
            [
                'titlePage' => 'Modification du commentaire',
                'article' => $article,
                //'comments' => $comments,$
                'comment' => $entity,
                'idArticle' => $comment->getArticleId(),
                'message' => 'Votre commentaire n\'a pas pu être modifer. Veuillez réessayer ou contacter l\'administrateur du site',
            ]
        );
        //throw new \Exception('Votre commentaire n\' a pas pu être modifié');
        return; // en attendant de trouver comment gérer avec une exception
        }

        $this->renderView(
            'article.html.twig',
            [
                'titlePage' => 'Article',
                'article' => $article,
                //'comments' => $comments,$
                'comments' => $comments,
                'idArticle' => $comment->getArticleId()
            ]
        );
    }

    public function deleteAction()
    {
        //$id = $this->getParams();
        $id = $this->callGetParam('id');
        (new commentManager())->delete($id);

        $articles = (new ArticleManager())->find();
        $this->renderView(
            'articles.html.twig',
            [
                'articles' => $articles,
                'message' => 'L\'article a bien été supprimé'
            ]
        );
    }
}
