<?php

namespace App\Controllers;

use Core\DefaultControllerAbstract;
use Core\Request;
use App\Repository\ArticleManager;
use App\Repository\CommentManager;
use App\Entity\Article;
use App\Entity\Comment;


class CommentController extends DefaultControllerAbstract
{
    public function indexAction()
    {
        /*
        $articleManager = new ArticleManager();
        $commentManager = new CommentManager();

        //$commentId = $this->getParams();
        $commentId = $this->getRequestParam('id');

        $comment = $commentManager->findOne($commentId);
        $article = $articleManager->findOne($comment->getArticleId());

        return $this->renderView(
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
        */

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

    public function newAction()
    {
        //$this->getRequestParam('articleId'));
        $entity = (new Comment())->hydrate($this->getRequestParam('comment'));
        (($entity->setArticleId($this->getRequestParam('articleId'))));
        $commentManager = (new CommentManager())->insert($entity);

        header('Location: /article/see?id=' . $entity->getArticleId());

        //$articles = (new ArticleManager())->find();
        /*
        $this->renderView(
            'articles.html.twig',
            [
                'titlePage' => 'Articles',
                'articles' => $articles,
                'message' => 'Le commentaire a été soumis avec succès'
            ]
        );
        */
    }

    public function editAction()
    {
        $articleManager = new ArticleManager();
        $commentManager = new CommentManager();
        $commentId = $this->getRequestParam('id');
        $comment = $commentManager->findOne($commentId);
        if (!$comment) {
                throw new \Exception('Le commentaire que vous souhaitez mettre jour n\'est plus disponible');
        }

        $article = $articleManager->findOne($comment->getArticleId());


        if($this->isSubmited('comment'))
        {
            // Code utilisé avant d'être déplacé avant le if
            /*
            $commentId = $this->getRequestParam('id');
            $commentManager = new CommentManager();
             Retrive the item to update it
            $comment = $commentManager->findOne($commentId);

            if (!$comment) {
                throw new \Exception('Le commentaire que vous souhaitez mettre jour n\'est plus disponible');
            }
            */
            $entity = $comment->hydrate($this->getRequestParam('comment'));
            $commentEdited = $commentManager->update($entity);

             // On récupère l'article et tous les commentaires associés
            //$articleManager = new ArticleManager();
            $article = $articleManager->findOne($comment->getArticleId());
            $comments = $commentManager->find(['articleId' => $comment->getArticleId()]);

            if (!$commentEdited) {
            return $this->renderView(
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
            }

            return $this->renderView(
                'article.html.twig',
                [
                    'titlePage' => 'Articlez',
                    'article' => $article,
                    //'comments' => $comments,$
                    'comments' => $comments,
                    'idArticle' => $comment->getArticleId(),
                    'action' => 'new'
                ]
            );
        }

        return $this->renderView(
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
    }

    public function deleteAction()
    {
        $id = $this->getRequestParam('id');
        $commentManager = new commentManager();
        // Get the article before to delete it to find article id
        $comment = $commentManager->findOne($id);
        $commentManager->delete($id);

        header('Location: /article/see?id=' . $comment->getArticleId());
        /*
        $articles = (new ArticleManager())->find();
        return $this->renderView(
            'articles.html.twig',
            [
                'titlePage' => 'Articles',
                'articles' => $articles,
                'message' => 'L\'article a bien été supprimé'
            ]
        );
        */
    }
}
