<?php

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

    public function voirAction()
    {
        require_once './Request.php';
        echo (new Request())->getParam('authentificationId', 'Authentification');
    }
}
