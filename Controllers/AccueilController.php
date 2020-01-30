<?php

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

    public function voirAction()
    {
        require_once './Request.php';
        $request = new Request();
        $articleId = $request->getParam('articleId');
        echo $articleId;
    }
}
