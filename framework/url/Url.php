<?php

class URL {

    private static $urls = array();
    private static $currentController = '';
    private static $currentAction = '';
    private static $url = '';
    private static $request = null;

    public static function init($config) {

        self::$request = new Request();
        self::$urls = $config;
        self::$url  = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');

    }

    public static function resolve($url) {

        $dp = Application::singelton('Dispatcher');

        //if we have no url set it to root
        //and start the index controller
        if(!isset($url) || $url == '/') {

            $url = '/';
            self::$currentController = 'index';
            self::$currentAction = 'index';
            $dp->buildAndCallController('IndexController', 'indexAction', array());

        } else {

            $uri = explode("/",$url);
            //check now if we have a config url
            $urlName = strtolower($uri[1]);
            foreach (self::$urls as $name => $settings) {
                if($urlName == $name) {
                    $dp->buildAndCallController(ucwords($settings['controller']).'Controller', $settings['action']."Action");
                    return;
                }
            }
            $controller = ucwords($uri[1]).'Controller';
            $action = isset($uri[2]) ? $uri[2]."Action" : 'indexAction';
            $params = isset($uri[3]) ? $uri[3] : array();
            self::$request->url = self::$url;
            $dp->buildAndCallController($controller, $action, $params);

        }

    }

    public static function getBaseURL() {
        return self::$url;
    }

    public static function getRequest() {
        return self::$request;
    }

}
