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
        $entity = new Comment([
            'article_id' => 4,
            'pseudo' => 'Blabla',
            'comment' => 'L\Aerty ressemble au qwerty',
        ]);
        echo '<br><br>';
        $entity = $entity->getAttributes();
        echo '<br>CLES : <br>';
        $commentManager = new CommentManager();
        $commentManager->save($entity);
    }
}
