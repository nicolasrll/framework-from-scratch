<?php

class AuthentificationController extends DefaultController
{
    public function indexAction($loader)
    {
        $this->renderView('Authentification', $loader);
    }
}
