<?php

namespace App\Controllers;

use Core\DefaultControllerAbstract;
use Core\Request;
use App\Repository\ArticleManager;
use App\Repository\CommentManager;
use App\Entity\Article;
use App\Entity\Comment;
use Exception;

class CommentController extends DefaultControllerAbstract
{
    public function indexAction(){}

    public function listAction()
    {
        $comments = (new CommentManager())->find();

        return $this->renderView(
            'back/comments.html.twig',
            [
                'titlePage' => 'Liste de tous les commentaire',
                'comments' => $comments
            ]
        );
    }

    public function newAction()
    {
        //$entity = (new Comment())->hydrate($this->getRequestParam('comment'));
        if (!$this->isSubmited('comment')) {
            throw new Exception ('L\'article n\'a pas pu être créé');
        }

        $entity = (new Comment())->hydrate($this->getFormValues('comment'));
        (($entity->setArticleId($this->getParamAsInt('id'))));
        (new CommentManager())->insert($entity);

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
        // Retrieve the comment
        $commentManager = new CommentManager();
        //$commentId = $this->getRequestParam('id');
        $commentId = $this->getParamAsInt('id');
        $comment = $commentManager->findOne($commentId);

        if (!$comment) {
            throw new Exception('Le commentaire que vous souhaitez mettre jour n\'est plus disponible');
        }

        // Retrieve article associated
        $articleManager = new ArticleManager();
        $article = $articleManager->findOne($comment->getArticleId());

        if($this->isSubmited('comment'))
        {
            //$entity = $comment->hydrate($this->getRequestParam('comment'));
            $entity = $comment->hydrate($this->getFormValues('comment'));
            $commentEdited = $commentManager->update($entity);

            if (!$commentEdited) {
                $comment = $commentManager->findOne($commentId);

                return $this->renderView(
                    'comment.html.twig',
                    [
                        'titlePage' => 'Modification du commentaire',
                        'article' => $article,
                        'comment' => $comment,
                        'submitedComment' => $entity,
                        'message' => 'Votre commentaire n\'a pas pu être modifer. Veuillez réessayer ou contacter l\'administrateur du site',
                    ]
                );
                //throw new Exception('Votre commentaire n\' a pas pu être modifié');
            }

            $comments = $commentManager->find(['articleId' => $comment->getArticleId()]);

            // If comment edited Return article associated and its comment
            return $this->renderView(
                'article.html.twig',
                [
                    'article' => $article,
                    'comments' => $comments,
                    'flashbag' => 'Votre commentaire a été modifié avec succès'
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
                'submitedComment' => $comment,
            ]
        );
    }

    public function deleteAction()
    {
        //$id = $this->getRequestParam('id');
        $id = $this->getParamAsInt('id');
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
