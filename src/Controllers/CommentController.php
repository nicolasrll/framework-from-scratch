<?php

namespace App\Controllers;

use Core\DefaultController;
use App\Entity\Comment;
use App\Repository\CommentManager;

class CommentController extends DefaultController
{
    public function indexAction()
    {
        $this->renderView(
            'accueil.html.twig',
            [
                'titlePage' => 'Accueil'
            ]
        );
    }

    public function saveAction()
    {
        /*
        $entity = new Comment([
            'article_id' => 7,
            'pseudo' => 'Antidote',
            'comment' => 'Je suis la solution',
        ]);
        */
        /*
        $postData = [
            'article_id' => 12,
            'pseudo' => $_POST['pseudo'],
            'comment' => $_POST['comment'],
        ];
        */
        $entity = (new Comment())->hydrate($_POST['comment']);
        $commentManager = (new CommentManager())->add($entity);
        //$commentManager->add($entity);
    }

    public function updateAction()
    {
        // On récupère l'article déjà existant via un get ici qu'on simule avec un new Article en brut
        // On instant ArticleManager
        // Puis on appelle la méthode update
        $postData = [
            'id' => 57,
            'article_id' => 4,
            'pseudo' => 'Dupont',
            'comment' => 'Design stylé!',
        ];
        $entity = (new Comment())->hydrate($postData);
        //$articleManager = (new ArticleManager())->save($entity);;
        $articleManager = (new CommentManager())->update($entity);

    }


}
