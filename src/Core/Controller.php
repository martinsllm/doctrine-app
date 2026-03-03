<?php

namespace App\Core;

use Exception;

class Controller 
{
    private $matchedUri;
    private $params;
    public function __construct($matchedUri, $params)
    {
        $this->matchedUri = $matchedUri;
        $this->params = $params;
    }

    public function index(){
        [$controller, $method] = explode('@', array_values($this->matchedUri)[0]);
        $controllerWithNamespace = 'App\\Controllers\\' . $controller;

        if(!class_exists($controllerWithNamespace)){
            throw new Exception("Controller {$controller} not found");
        }

        $controllerInstance = new $controllerWithNamespace();

        if(!method_exists($controllerInstance, $method)){
            throw new Exception("Method {$method} not found in controller {$controller}");
        }

        $controllerInstance->$method($this->params);
    }

}