<?php

namespace Core;

/**
 * Used to execute the action in the asssociated controller
 */
class Dispatcher
{
    private $router = null;
    private $controllerPath = '';
    private $controller = null;

    /**
     * Initialize property router and controllerPath
     *
     * Exemple:
     *     monsite.fr/article/voir
     *
     *     new Router() = {
     *         controllerPath : 'Controllers/ArticleController.php'
     *         controller : object(ArticleController)
     *     }
     *
     *     monsite.fr/article
     *     new Router() = {
     *         controllerPath : 'Controllers/ArticleController.php'
     *         controller : object(ArticleController)
     *     }
     *
     *     monsite.fr/
     *     new Router() = {
     *         controllerPath : 'Controllers/AccueilController.php'
     *         controller : object(ArticleController)
     *     }
     */
    public function __construct()
    {
    	$this->router = new Router();
	    $this->controllerPath = 'src/Controllers/' . ucfirst($this->router->getControllerName()) . '.php';
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
     * Getter for controller instance
     */
    public function getController()
    {
        return $this->controller;
    }

    /**
     * Setter for controller instance
     */
    public function setController($controller)
    {
        $controller = 'App\Controllers\\'.$controller;
        $this->controller = new $controller;
    }

    /**
     * Check if controller file exist, include it and call the function action
     */
    public function dispatch(): void
    {
        if (!file_exists($this->getControllerPath()))
        {
            throw new \Exception('Le controller recherché n\'existe pas');
        }

        require_once($this->getControllerPath());

        $this->setController($this->getRouter()->getControllerName());

        if (!method_exists($this->controller, $this->getRouter()->getActionName()))
        {
            throw new \Exception('L\'action demandé n\'est pas disponible');
        }

        call_user_func([$this->getController() , $this->router->getActionName()]);
    }
}
