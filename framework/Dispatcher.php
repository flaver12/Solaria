<?php

class Dispatcher {


    private $currentController;
    private $currentAction;

    public function buildAndCallController($controller, $action, $arguments = array()) {
        $this->currentController = str_replace('controller', '', strtolower($controller));
        $this->currentAction = str_replace('action', '', strtolower($action));

        //prepare the vars
        if(!class_exists($controller)) {
            throw new Exception("Class ".$controller. " does not exist!");
        }

        if(method_exists($controller, $action)) {
            call_user_func_array(array($controller, $action), $arguments);
        } else {
            throw new Exception("Method ".$action. " does not exist!");
        }
    }

    public function getController() {
        return $this->currentController;
    }

    public function getAction() {
        return $this->currentAction;
    }

    public function setController($controller) {
        $this->currentController = strtolower($controller);
    }

    public function setAction($action) {
        $this->currentAction = strtolower($action);
    }

}
