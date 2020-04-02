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
        $articles = $articleManager->find();

        $this->renderView(
            'articles.html.twig',
            [
                'articles' => $articles
            ]
        );
    }

    // Ex indexAction avant le groupe de ArticlesController ici
    public function seeAction()
    {
        $articleManager = new ArticleManager();
        $commentManager = new CommentManager();
        //$articleId = $this->getParams();
        $articleId = $this->callGetParam('id');

        $article = $articleManager->findOne($articleId);

        $comments = $commentManager->find(['articleId' => $articleId]);
        $this->renderView(
            'article.html.twig',
            [
                'titlePage' => 'Article',
                'article' => $article,
                'comments' => $comments,
                'action' => 'insert'
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

    public function insertAction()
    {
        //$article = (new Article())->hydrate($_POST['article']);
        //$article = (new Article())->hydrate((Request::getInstance())->getParam('article'));
        $article = (new Article())->hydrate($this->callGetParam('article'));
        $result = (new ArticleManager())->insert($article);

        $articleManager = new ArticleManager();
        $articles = (new ArticleManager())->find();

        $this->renderView(
           'articles.html.twig',
            [
                'articles' => $articles
            ]
        );
    }

    public function editAction()
    {
        // On récupère l'article déjà existant via un get ici qu'on simule avec un new Article en brut
        // On instant ArticleManager
        // Puis on appelle la méthode update
        //$articleId = (Request::getInstance())->getParam('id');
        $articleId = $this->callGetParam('id');

        if (null == $articleId) {
            throw new \Exception('Une erreur s\'est produite');
        }

        // On vérfiie qu'un article correspondant à l'id existe
        $articleManager = new ArticleManager();
        $article = $articleManager->findOne($articleId);

        if (!$article) {
            throw new \Exception('L\'article que vous souhaitez mettre à jour n\'est plus disponible');
        }

        // On récupère les éléments du formulaire d'édition
        // METTRE UNE CONDITIONC ISSET OU EMPTY

        //$entity = $article->hydrate((Request::getInstance())->getParam('article'));
        $entity = $article->hydrate($this->callGetParam('article'));

        // throw exception ici pour gérer le cas où le formulaire a pas été soumis

        $entity->setId($articleId);

        //$articleManager = (new ArticleManager())->save($entity);;
        //$articleManager = (new ArticleManager())->edit($entity);
        $articleEdited = $articleManager->edit($entity);

        if (!$articleEdited) {
            // Si les données on pas pu être modifé en bdd
            // Alors on affiche les données modifié par le visiteur avec un message d'erreur
        }

        // On renvoit vers la vue article
        //$articleManager = new ArticleManager();
        $commentManager = new CommentManager();
        $article = $articleManager->findOne($articleId);
        $comments = $commentManager->find(['article_id' => $articleId]);
        $this->renderView(
            'article.html.twig',
            [
                'titlePage' => 'Article',
                'article' => $article,
                'comments' => $comments,
                'idArticle' => $articleId
            ]
        );
    }

    public function deleteAction()
    {
        //$id = $this->getParams();
        $id = $this->callGetParam('id');
        $articleManager = new ArticleManager();
        $articleDeleted = ($articleManager->delete($id));

        if (!$articleDeleted) {
            throw new \Exception('L\'article n\'a pas pu être supprimé ou  a été supprimé entre temps. <a href="/article">Retour aux articles</a>');
        }

        $articles = $articleManager->find();
        $this->renderView(
            'articles.html.twig',
            [
                'articles' => $articles,
                'message' => 'L\'article a bien été supprimé'
            ]
        );
    }
}
