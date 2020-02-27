<?php

namespace App\Controllers;

use Core\DefaultController;

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
