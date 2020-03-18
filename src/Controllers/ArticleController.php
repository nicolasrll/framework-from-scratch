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
        $article = $articleManager->find($idArticle);
        //echo '<br><br>';
        //$commentManager->find(['article_id' => $idArticle]));
    }

    public function saveAction()
    {
        /*
        $entity = new Article([
            'title' => 'Mon titre',
            'content' => 'Mon contenue',
        ]);
        */

        /*
        $entity->hydrate([
             'title' => 'Mon titre',
            'content' => 'Mon contenue',
        ]);
        */
        $postData = [
            'title' => $_POST['title'],
            'content' => $_POST['content'],
        ];
        $article = (new Article())->hydrate($postData);

        $result = (new ArticleManager())->save($article);
    }

    public function updateAction()
    {
        // On récupère l'article déjà existant via un get ici qu'on simule avec un new Article en brut
        // On instant ArticleManager
        // Puis on appelle la méthode update
        $postData = [
            'id' => 25,
            'title' => 'Une titre',
            'content' => 'Un contenu pas comme un autre',
        ];
        $entity = (new Article())->hydrate($postData);
        $articleManager = (new ArticleManager())->save($entity);;
        //$articleManager->update($entity);

    }
}
