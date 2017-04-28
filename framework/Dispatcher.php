<?php
namespace FM\Framework;

use FM\Framework\Acl\Acl;
use FM\App\Models\Resource;
use Exception;

class Dispatcher {


    private $currentController;
    private $currentAction;

    public function buildAndCallController($controller, $action, $arguments = array()) {
        $this->currentController = str_replace('controller', '', strtolower($controller));
        $this->currentAction = str_replace('action', '', strtolower($action));

        //resourceName
        $resourceName = $controller;
        //add namespace
        $controller = 'FM\App\controllers\\'.$controller;

        //prepare the vars
        if(!class_exists($controller)) {
            throw new \Exception("Class ".$controller. " does not exist!");
        }

        if(method_exists($controller, $action)) {
            //do the acl check
            $acl            = new Acl(Session::get('user'));
            $result         = Resource::findBy(array('name' => $resourceName.'.'.$action));
            $resultStart    = Resource::findBy(array('name' => $resourceName.'.*'));

            if(empty($result) && empty($resultStart)) {
                call_user_func_array(array(new $controller, $action), $arguments);
            } else {
                if(empty($result) && !empty($resultStart)) {
                    if($acl->hasNeededRole($resultStart)) {
                        call_user_func_array(array(new $controller, $action), $arguments);
                    } else {
                        throw new Exception("NO ERROR CONTROLLER DEFINED!");

                    }
                } else {
                    if($acl->hasPermission($result)) {
                        call_user_func_array(array(new $controller, $action), $arguments);
                    } else {
                        throw new Exception("NO ERROR CONTROLLER DEFINED!");

                    }
                }
            }

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
