<?php

namespace App\Controllers;

use Core\DefaultControllerAbstract;

class AccueilController extends DefaultControllerAbstract
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
