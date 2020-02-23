<?php

require_once(PROJECT_ROOT_PATH . '/core/DefaultController.php');

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
