<?php

/**
 * Used to execute the action in the asssociated controller
 */

class Dispatcher
{
    private $router;
    private $controllerPath = '';
    private $controller;
    private  $controllerName;

    /**
     * Initialize property router and controllerPath
     */
    public function __construct(Router $router)
    {
        $this->setRouter($router);
        $this->setControllerPath($this->getRouter()->getControllerName());
    }

    /**
     * Getter for instance of router
     * @return Router
     */
    public function getRouter(): Router
    {
        return $this->router;
    }

    /**
     * Setter for instance of router
     * @param Router $router [description]
     */
    public function setRouter(Router $router)
    {
        $this->router = $router;
    }

    /**
     * Getter for controllerPath
     * @return string Path to the file controller
     */
    public function getControllerPath(): string
    {
        return $this->controllerPath;
    }

    /**
     * Setter for controllerPath
     * @param string Controller name
     */
    public function setControllerPath(string $controllerName)
    {
        $this->controllerPath = 'Controllers/'.ucfirst($controllerName).'.php';
    }

    /**
     * Getter for controller instance
     */
    public function getController()
    {
        return $this->controller;
    }

    /**
     * Setter for controller instance
     */
    public function setController($controllerName)
    {
        $this->controller = new $controllerName;
    }

    /**
     * Check if controller file exist, include it and call the function action
     */
    public function dispatch()
    {
        if (!file_exists($this->getControllerPath()))
        {
            throw new Exception('Le controller recherché n\'existe pas');
        }

        require_once('Controllers/DefaultController.php');
        require_once($this->getControllerPath());

        $this->setController($this->getRouter()->getControllerName());

        if (!method_exists($this->controller, $this->getRouter()->getActionName()))
        {
            throw new Exception('L\'action demandé n\'est pas disponible');
        }

        call_user_func(array($this->getController() , $this->router->getActionName()));
    }
}
