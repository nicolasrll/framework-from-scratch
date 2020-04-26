<?php

namespace App\Controllers;

use Core\DefaultControllerAbstract;

class HomeController extends DefaultControllerAbstract
{
    public function indexAction()
    {
        $this->renderView(
            'home.html.twig',
            [
                'titlePage' => 'Accueil'
            ]
        );
    }
}
