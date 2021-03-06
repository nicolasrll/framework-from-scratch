<?php

namespace App\Controllers;

use Core\DefaultController;

class AuthentificationController extends DefaultController
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
