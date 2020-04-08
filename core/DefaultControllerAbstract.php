<?php

namespace Core;

use Twig\Loader\FilesystemLoader;
use Twig\Environment;

abstract class DefaultControllerAbstract
{
    abstract protected function indexAction();

    protected function renderView(string $view, array $params = [])
    {
        require_once 'vendor/autoload.php';

        $loader = new FilesystemLoader('template/');
        $twig = new Environment($loader);
        $twig->addExtension(new \Twig\Extension\DebugExtension());
        echo $twig->render($view, $params);
    }

/*
    public function getParams()
    {
        $articleId = (Request::getInstance())->getParam('id');

        return $articleId;
    }
*/

    public function getRequestParam($searching)
    {
        return (Request::getInstance())->getParam($searching);
    }

    public function getParamAsInt($searching)
    {
        if (!is_int($searching)) {
            throw new \Exception('Une erreur est survenue');
        }

        return true;
    }

    public function isSubmited($arg)
    {
        if (empty($arg)) {
            throw new \Exception('Un problème est survenu');
        }

        return $this->getRequestParam($arg);
    }
}

