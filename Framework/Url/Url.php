<?php

namespace FM\Framework\Url;

use FM\Framework\Url\Request;
use FM\Framework\Application;

class Url {

    private static $urls = array();
    private static $currentController = '';
    private static $currentAction = '';
    private static $url = '';
    private static $urlPath = '';
    private static $request = null;

    public static function init($config) {

        self::$request = new Request();
        self::$urls = $config;
        self::$urlPath = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
        self::$url  = str_replace('/public', '', self::$urlPath);
    }

    public static function resolve($url) {

        $dp = Application::singleton('FM\Framework\Dispatcher');

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
                //check if we have to parse the current setting
                if(strpos($name, ':action') !== false && strpos($name, $urlName) !== false) {
                    $action = (isset($uri[2]) && $uri[2] != '' ) ? $uri[2]."Action" : 'indexAction';
                    self::resolveWithParams(ucwords($settings['controller']).'Controller', $action, $uri);
                }
                if($urlName == $name) {
                    $params = array();
                    for ($i=2; $i < (count($uri)); $i++) {
                        array_push($params, $uri[$i]);
                    }
                    $dp->buildAndCallController(ucwords($settings['controller']).'Controller', $settings['action']."Action", $params);
                    return;
                }
            }

            if($uri[0] == "") {
                $uri = array_splice($uri, 1);
            }

            $controller = ucwords($uri[0]).'Controller';
            $action = (isset($uri[1]) && $uri[1] != '' ) ? $uri[1]."Action" : 'indexAction';
            self::resolveWithParams($controller, $action, $uri);


        }

    }

    private static function resolveWithParams($controller, $action, $uri) {
        $dp = Application::singleton('FM\Framework\Dispatcher');
        $params = array();

        for ($i=2; $i < (count($uri)); $i++) {
            array_push($params, $uri[$i]);
        }
        self::$request->url = self::$url;

        if(strpos($action, '-') !== false) {
             $action = lcfirst(str_replace('-', '', ucwords($action, '-')));
        }

        $dp->buildAndCallController($controller, $action, $params);
    }

    public static function getBaseURL() {
        return self::$url;
    }

    public static function getUrlPath() {
        return self::$urlPath;
    }

    public static function getRequest() {
        return self::$request;
    }

}
