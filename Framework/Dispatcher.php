<?php
namespace Solaria\Framework;

use Solaria\Framework\Application;
use Solaria\Framework\Session;
use Exception;

class Dispatcher {


    private $currentController;
    private $currentAction;

    public function buildAndCallController($controller, $action, $arguments = array()) {
        $this->currentController = str_replace('controller', '', strtolower($controller));
        $this->currentAction = $this->from_camel_case(str_replace('Action', '', $action));

        //resourceName
        $resourceName = $controller;
        //add namespace
        $controller = 'Solaria\App\Controllers\\'.$controller;

        //prepare the vars
        if(!class_exists($controller)) {
            throw new \Exception("Class ".$controller. " does not exist!");
        }

        if(method_exists($controller, $action)) {

            //acl
            $acl = Application::singleton('acl');
            if(Session::exist('user')) {
                
            } else {

            }

            call_user_func_array(array(new $controller, $action), $arguments);
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

    /**
    *@see http://stackoverflow.com/questions/1993721/how-to-convert-camelcase-to-camel-case
    */
    private function from_camel_case($input) {
      preg_match_all('!([A-Z][A-Z0-9]*(?=$|[A-Z][a-z0-9])|[A-Za-z][a-z0-9]+)!', $input, $matches);
      $ret = $matches[0];
      foreach ($ret as &$match) {
        $match = $match == strtoupper($match) ? strtolower($match) : lcfirst($match);
      }
      return implode('-', $ret);
    }

}
