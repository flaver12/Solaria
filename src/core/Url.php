<?php

class URL {

    private static $urls = array();
    private static $currentController = '';
    private static $currentAction = '';
    private static $url = '';

    public static function init($config) {

        self::$urls = $config;
        self::$url  = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');

    }

    public static function resolve($url) {

        //if we have no url set it to root
        //and start the index controller
        if(!isset($url) || $url == '/') {

            $url = '/';
            self::$currentController = 'index';
            self::$currentAction = 'index';
            self::buildAndCallController('IndexController', 'indexAction', array());

        } else {

            $uri = explode("/",$url);
            //check now if we have a config url
            $urlName = strtolower($uri[1]);
            foreach (self::$urls as $name => $settings) {
                if($urlName == $name) {
                    self::$currentController = strtolower($settings['controller']);
                    self::$currentAction = strtolower($settings['action']);
                    self::buildAndCallController(ucwords($settings['controller']).'Controller', $settings['action']."Action");
                    return;
                }
            }

            self::$currentController = strtolower($uri[1]);
            self::$currentAction = strtolower($uri[2]);
            $controller = ucwords($uri[1]).'Controller';
            $action = $uri[2]."Action";
            $params = isset($uri[3]) ? $uri[3] : array();
            self::buildAndCallController($controller, $action, $params);

        }

    }

    private static function buildAndCallController($controller, $action, $arguments = array()) {

        //prepare the vars
        if(!class_exists($controller)) {
            throw new Exception("Class ".$controller. " does not exist!");
        }

        $controller = new $controller();

        if(method_exists($controller, $action)) {
            call_user_func_array(array($controller, $action), $arguments);
        } else {
            throw new Exception("Method ".$action. " does not exist!");
        }
    }

    public static function getController() {
        return self::$currentController;
    }

    public static function getAction() {
        return self::$currentAction;
    }

    public static function getBaseURL() {
        return self::$url;
    }

}
