<?php

/**
 * Used to retrieve controllerName and actionName in request
 *
 * @author Nicolas Rellier <nicolasrellier@yahoo.fr>
 */

class Router
{
    private $request;
    private $controllerName = '';
    private $actionName = '';

    /**
     * initialize $request with object passed in parameter,
     * $controllerName and $actionName with url exploded
     */
    public function __construct(Request $request)
    {
        $this->setRequest($request);
        $this->setControllerName($this->request->getUrlExplodedByIndex(0));
        $this->setActionName($this->request->getUrlExplodedByIndex(1));
    }

    public function getRequest(): ?Request
    {
        return $this->request;
    }

    public function setRequest(Request $request)
    {
        $this->request = $request;
    }

    public function getControllerName(): ?string
    {
        return $this->controllerName;
    }

    public function setControllerName(string $controller = null)
    {
        $this->controllerName = 'articles';

        if (null != $controller) {
            $this->controllerName = $controller;
        }
    }

    public function getActionName(): ?string
    {
        return $this->actionName;
    }

    public function setActionName(string $action = null)
    {
        $this->actionName = 'index';

        if (null != $action) {
            $this->actionName = $action;
        }
    }
}
