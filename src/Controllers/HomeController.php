<?php

namespace App\Controllers;

use Core\DefaultControllerAbstract;

class HomeController extends DefaultControllerAbstract
{
    public function indexAction()
    {
        $this->renderView(
            'front/home.html.twig',
            [
                'titlePage' => 'Accueil'
            ]
        );
    }

    public function contactAction()
    {
        $contact = $this->getFormValues('contact');
        $message = ' nom prénom : ' . $contact['fullname'] .' email de contact: '. $contact['email'] . ' message :'. $contact['message'] ;
        mail('nicolasrellier@yahoo.fr','Nouveau message laissé sur ton site', "test");
        // Not working !

    }
}
