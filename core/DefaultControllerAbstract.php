<?php

namespace Core;

use Twig\Loader\FilesystemLoader;
use Twig\Environment;
use Exception;
//use TypeError;

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

    // Commenté car plus si utile maintenant que j'utile getParamAsInt
    /*
    public function getRequestParam(string $searching)
    {
        return (Request::getInstance())->getParam($searching);
    }
    */

    public function getParamAsInt(string $searching): ?int
    {
        $searchValue = (Request::getInstance())->getParam($searching);

        return $searchValue ? (int) $searchValue : null;
    }

    /**
     * Called to get values submited in form
     * @param  [string] $searching [description]
     * @return [array]            Return
     */
    public function getFormValues(string $searching): array
    {
        $searchValue = (Request::getInstance())->getParam($searching);

        return is_array($searchValue) ? $searchValue : [$searchValue];
    }

    /*
    public function getParamAsInt($searching)
    {
        if (!is_int($searching)) {
            throw new Exception('Une erreur est survenue');
        }

        return true;
    }
    */


    public function isSubmited(string $arg): bool
    {
        // Check if we passed another thing than an array
        if($this->getFormValues($arg) == [null]) {
            return false;
        }

        return true;
    }

    /*
    public function isSubmited($arg)
    {
        if (empty($arg)) {
            throw new Exception('Un problème est survenu');
        }

        return $this->getRequestParam($arg);
    }
    */
}

