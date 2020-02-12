<?php

class Router
{
    private $request;
    private $controllerName = '';
    private $actionName = '';

    public function __construct()
    {
        $this->setRequest(new Request());
        $this->setControllerName($this->request->getUrlExplodedByIndex(0));
        $this->setActionName($this->request->getUrlExplodedByIndex(1));
    }

    public function getRequest(): ?Request
    {
        return $this->request;
    }

    public function setRequest(Request $arg)
    {
        $this->request = $arg;
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
