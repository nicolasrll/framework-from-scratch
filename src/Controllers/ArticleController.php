<?php

namespace App\Controllers;

use Core\DefaultControllerAbstract;
use Core\Request;
use App\Repository\ArticleManager;
use App\Repository\CommentManager;
use App\Entity\Article;
use App\Entity\Comment;

//use App\Repository\AbstractManager;
//use App\Entity\Article;

class ArticleController extends DefaultControllerAbstract
{

    public function indexAction()
    {
        $articles = (new ArticleManager())->find();

        return $this->renderView(
            'articles.html.twig',
            [
                'titlePage' => 'Articles',
                'articles' => $articles
            ]
        );
    }

    // Ex indexAction avant le groupe de ArticlesController ici
    public function seeAction()
    {
        $articleManager = new ArticleManager();
        $commentManager = new CommentManager();
        $articleId = $this->getRequestParam('id');
        $article = $articleManager->findOne($articleId);
        $comments = $commentManager->find(['articleId' => $articleId]);

        return $this->renderView(
            'article.html.twig',
            [
                'titlePage' => 'Article',
                'article' => $article,
                'comments' => $comments,
                'action' => 'new',
                //'idArticle' => $articleId
            ]
        );
    }

    // Renomer en getParams() dans DefaultController
    /*
    public function voir()
    {
        $articleId = (Request::getInstance())->getParam('id');

        return $articleId;
    }
    */

    public function newAction()
    {
        if ($this->isSubmited('article')) {
            $article = (new Article())->hydrate($this->getRequestParam('article'));
            $result = (new ArticleManager())->insert($article);

            header('Location: /article/see?id=' . $result);
            /*
            $articles = (new ArticleManager())->find();
            return $this->renderView(
                'articles.html.twig',
                [
                    'titlePage' => 'Articles',
                    'articles' => $articles
                ]
            );
            */
        }

        return $this->renderView(
            'articleform.html.twig',
            [
                'titlePage' => 'Edition d\'un article',
                'article' => $article,
                'idArticle' => $articleId,
                'action' => 'new'
            ]
        );
    }

    public function editAction()
    {
        $articleId = $this->getRequestParam('id');

        if (null == $articleId) {
            throw new \Exception('Une erreur s\'est produite');
        }

        $articleManager = new ArticleManager();
        $article = $articleManager->findOne($articleId);

        if (!$article) {
            throw new \Exception('L\'article que vous souhaitez mettre à jour n\'est plus disponible');
        }

        if ($this->isSubmited('article')) {
            $entity = $article->hydrate($this->getRequestParam('article'));
            $articleEdited = $articleManager->update($entity);
            if (!$articleEdited) {
                throw new \Exception('L\'article n\'a pas pu $etre modifié');
            }

            $commentManager = new CommentManager();
            $comments = $commentManager->find(['articleId' => $entity->getId()]);
            //$flashbag = 'Votre article a été modifié avec succès';
            return $this->renderView(
                'article.html.twig',
                [
                    'titlePage' => 'Article',
                    'article' => $article,
                    'comments' => $comments,
                    //'idArticle' => $articleId,
                    'message' => 'Votre article a été modifié avec succès'
                ]
            );
        }

        // Sinon on renvoi vers la vue articleform
        return $this->renderView(
            'articleform.html.twig',
            [
                'titlePage' => 'Edition d\'un article',
                'article' => $article,
                'idArticle' => $articleId,
                'action' => 'edit?id='.$articleId
            ]
        );
    }

    public function deleteAction()
    {
        //$id = $this->getParams();
        $id = $this->getRequestParam('id');
        $articleManager = new ArticleManager();
        $articleDeleted = ($articleManager->delete($id));

        if (!$articleDeleted) {
            throw new \Exception('L\'article n\'a pas pu être supprimé ou  a été supprimé entre temps.');
        }

        header('Location: /article');
    }
}
