<?php
namespace App\Controllers;

require_once(PROJECT_ROOT_PATH . '/core/DefaultController.php');

class AccueilController extends \core\DefaultController
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
