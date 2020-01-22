<?php

class AccueilController extends DefaultController
{
    public function indexAction($loader)
    {
        $this->renderView('Accueil', $loader);
    }
}
