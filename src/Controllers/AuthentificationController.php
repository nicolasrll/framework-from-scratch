<?php

namespace App\Controllers;

use Core\DefaultControllerAbstract;

class AuthentificationController extends DefaultControllerAbstract
{
    public function indexAction()
    {
        $this->renderView(
            'authentification.html.twig',
            [
                'titlePage' => 'Authentification'
            ]
        );
    }
}
