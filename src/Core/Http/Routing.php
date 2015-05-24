<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Routing
 *
 * @author john-vostro
 */

namespace Core\Http;

class Routing {

    public function __construct() {
        
    }

    public function init() {
        $namespace = 'Controller\\';
        $params = $_REQUEST;
        $controllerPrefix = ucfirst($params['controller']);
        $actionPrefix = strtolower($params['action']);

        $controller = $namespace . $controllerPrefix . 'Controller';
        $action = $actionPrefix . 'Action';

        $controllerObject = new $controller;
        $params = (object) $controllerObject->$action();

        $view = BASE_DIR . 'View/' . strtolower($controllerPrefix) . DIRECTORY_SEPARATOR . $actionPrefix.'.phtml';
        require_once $view;
        return $params;
      
    }

}
