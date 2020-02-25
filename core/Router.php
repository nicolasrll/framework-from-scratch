<?php
namespace Core;

/**
 * Used to retrieve controllerName and actionName in request
 *
 * @author Nicolas Rellier <nicolasrellier@yahoo.fr>
 */

class Router
{
    private $request;
    private $controllerName = 'AccueilController';
    private $actionName = 'indexAction';
    const CONTROLLER_POSITION = 0;
    const ACTION_POSITION = 1;

    /**
     * initialize $request with object passed in parameter,
     * $controllerName and $actionName with url exploded
     *
     * Exemple:
     *     monsite.fr/article/voir
     *
     *     new Router() = {
     *         controllerName : 'ArticleController'
     *         actionName : 'voirAction'
     *     }
     *
     *     monsite.fr/article
     *     new Router() = {
     *         controllerName : 'ArticleController'
     *         actionName : 'indexAction'
     *     }
     *
     *     monsite.fr/
     *     new Router() = {
     *         controllerName : 'AccueilController'
     *         actionName : 'indexAction'
     *     }
     */
    public function __construct()
    {
        $this->setRequest(new Request());
        $controllerName = $this->getRequest()->getUrlExplodedByIndex(self::CONTROLLER_POSITION) ?? 'Accueil';
        $actionName = $this->getRequest()->getUrlExplodedByIndex(self::ACTION_POSITION) ?? 'index';
        $this->setControllerName($controllerName);
        $this->setActionName($actionName);
    }

    public function getRequest(): Request
    {
        return $this->request;
    }

    public function setRequest(Request $request)
    {
        $this->request = $request;
    }

    public function getControllerName(): string
    {
        return $this->controllerName;
    }

    public function setControllerName(string $controllerName)
    {
        if (!empty($controllerName)) {
            $this->controllerName = ucfirst($controllerName).'Controller';
        }
    }

    public function getActionName(): string
    {
        return $this->actionName;
    }

    public function setActionName(string $actionName)
    {
        if (!empty($actionName)) {
            $this->actionName = $actionName . 'Action';
        }
    }
}
