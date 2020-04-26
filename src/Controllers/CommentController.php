<?php

namespace App\Controllers;

use Core\DefaultControllerAbstract;
//use Core\Request;
use App\Repository\ArticleManager;
use App\Repository\CommentManager;
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
            'front/articles.html.twig',
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
        $comment = $commentManager->findOneById($commentId);

        if (!$comment) {
            throw new Exception('Le commentaire que vous souhaitez mettre jour n\'est plus disponible');
        }

        // Retrieve article associated
        $articleManager = new ArticleManager();
        $article = $articleManager->findOneById($comment->getArticleId());

        if ($this->isSubmited('comment')) {
            //$entity = $comment->hydrate($this->getRequestParam('comment'));
            $entity = $comment->hydrate($this->getFormValues('comment'));
            $commentEdited = $commentManager->update($entity);

            if (!$commentEdited) {
                $comment = $commentManager->findOneById($commentId);

                return $this->renderView(
                    'front/comment.html.twig',
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
                'front/article.html.twig',
                [
                    'article' => $article,
                    'comments' => $comments,
                    'flashbag' => 'Votre commentaire a été modifié avec succès',
                ]
            );
        }

        return $this->renderView(
            'front/comment.html.twig',
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
        $comment = $commentManager->findOneById($id);
        $commentManager->delete($id);

        header('Location: /article/see?id=' . $comment->getArticleId());
        /*
        $articles = (new ArticleManager())->find();
        return $this->renderView(
            'front/articles.html.twig',
            [
                'titlePage' => 'Articles',
                'articles' => $articles,
                'message' => 'L\'article a bien été supprimé'
            ]
        );
        */
    }
}
