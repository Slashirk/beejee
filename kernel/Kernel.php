<?php

namespace kernel;

use kernel\exceptions\InvalidRouteException;

class Kernel
{
    public $defaultControllerName = 'Site';
    public $defaultActionName     = "index";

    public function launch()
    {
        list($controllerName, $actionName, $params) = Application::$router->resolve();
        echo $this->launchAction($controllerName, $actionName, $params);
    }

    public function launchAction($controllerName, $actionName, $params)
    {
        $controllerName = empty($controllerName) ? $this->defaultControllerName : ucfirst($controllerName);
        $controllerName .= 'Controller';

        if (!file_exists(ROOTPATH . DIRECTORY_SEPARATOR . 'controllers' . DIRECTORY_SEPARATOR . $controllerName . '.php')) {
            throw new InvalidRouteException();
        }

        require_once ROOTPATH . DIRECTORY_SEPARATOR . 'controllers' . DIRECTORY_SEPARATOR . $controllerName . '.php';
        if (!class_exists("\\controllers\\" . ucfirst($controllerName))) {
            throw new InvalidRouteException();
        }
        $controllerName = "\\controllers\\" . ucfirst($controllerName);
        $controller = new $controllerName;
        $actionName = empty($actionName) ? $this->defaultActionName : $actionName;
        if (!method_exists($controller, $actionName)) {
            throw new InvalidRouteException();
        }
        return $controller->$actionName($params);

    }
}
