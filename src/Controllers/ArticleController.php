<?php

namespace App\Controllers;

use Core\DefaultControllerAbstract;
use Core\Request;
use App\Repository\ArticleManager;
use App\Repository\CommentManager;
use App\Entity\Article;
use App\Entity\Comment;
use Exception;

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
        $articleId = $this->getParamAsInt('id');
        $article = $articleManager->findOne($articleId);
        $comments = $commentManager->find(['articleId' => $articleId]);

        return $this->renderView(
            'article.html.twig',
            [
                'article' => $article,
                'comments' => $comments,
                'action' => 'new',
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
            $article = (new Article())->hydrate($this->getFormValues('article'));
            $result = (new ArticleManager())->insert($article);

            header('Location: /article/see?id=' . $result);
        }

        return $this->renderView(
            'back/article_new.html.twig',
            [
                'titlePage' => 'Création d\'un article',
                'idArticle' => $articleId,
            ]
        );
    }

    public function editAction()
    {
        $articleId = $this->getParamAsInt('id');

        if (null == $articleId) {
            throw new Exception('Une erreur s\'est produite');
        }

        $articleManager = new ArticleManager();
        $article = $articleManager->findOne($articleId);

        if (!$article) {
            throw new Exception('L\'article que vous souhaitez mettre à jour n\'est plus disponible');
        }

        if ($this->isSubmited('article'))
        {
            $entity = $article->hydrate($this->getFormValues('article'));

            $articleEdited = $articleManager->update($entity);

            // Useless because it's checkec with previous exception
            /*
            if (!$articleEdited) {
                throw new Exception('L\'article n\'a pas pu $etre modifié');
            }
            */

            $commentManager = new CommentManager();
            $comments = $commentManager->find(['articleId' => $entity->getId()]);

            return $this->renderView(
                'article.html.twig',
                [
                    'article' => $article,
                    'comments' => $comments,
                    'flashbag' => 'Votre article a été modifié avec succès'
                ]
            );
        }

        // Sinon on renvoi vers la vue articleform
        return $this->renderView(
            'back/article_edit.html.twig',
            [
                'titlePage' => 'Edition d\'un article',
                'article' => $article,
                'articleId' => $articleId
            ]
        );
    }

    public function deleteAction()
    {
        $id = $this->getParamAsInt('id');
        $articleManager = new ArticleManager();
        $articleDeleted = ($articleManager->delete($id));

        header('Location: /article');
    }
}
