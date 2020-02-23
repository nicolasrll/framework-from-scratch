<?php

require_once(PROJECT_ROOT_PATH . '/core/DefaultController.php');

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
