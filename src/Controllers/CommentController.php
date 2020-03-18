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
        $postData = [
            'article_id' => 12,
            'pseudo' => $_POST['pseudo'],
            'comment' => $_POST['comment'],
        ];
        $entity = (new Comment())->hydrate($postData);
        $commentManager = (new CommentManager())->save($entity);
        //$commentManager->add($entity);

    }
}
