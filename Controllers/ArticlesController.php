<?php

require_once(PROJECT_ROOT_PATH . '/core/DefaultController.php');

class ArticlesController extends DefaultController
{
    public function indexAction()
    {
        $this->renderView(
            'articles.html.twig',
            [
                'titlePage' => 'Articles'
            ]
        );
    }
}
