<?php

namespace App\Controllers;

use Core\DefaultController;

class AccueilController extends DefaultController
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
}
