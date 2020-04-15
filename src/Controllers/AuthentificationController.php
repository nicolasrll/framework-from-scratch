<?php

namespace App\Controllers;

use Core\DefaultControllerAbstract;
use Core\Request;
use Exception;


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

    public function loginAction()
    {
        if($this->isSubmited('authentification')) {


        }
        return $this->renderView(
            'authentification.html.twig'
        );
        /*
        $infos = ($this->getFormValues('authentification'));
        foreach ($infos as $info) {
            echo $info . '<br>';
        }
        $passwordHache = password_hash('toto', PASSWORD_DEFAULT);
        echo $passwordHache;
        */

    }

    public function registrationAction()
    {
        if($this->isSubmited('authentification')) {
            // Gérer le code lorsqu'on soumet le formulaire
            echo 'form submited';
            return; // en attendant
        }
        return $this->renderView(
            'registration.html.twig'
        );

    }
}
