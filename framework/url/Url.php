<?php

namespace FM\Framework\url;

use FM\Framework\url\Request;
use FM\Framework\Application;

class URL {

    private static $urls = array();
    private static $currentController = '';
    private static $currentAction = '';
    private static $url = '';
    private static $surl = '';
    private static $request = null;

    public static function init($config) {

        self::$request = new Request();
        self::$urls = $config;
        self::$url  = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');

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
                if($urlName == $name) {
                    $dp->buildAndCallController(ucwords($settings['controller']).'Controller', $settings['action']."Action");
                    return;
                }
            }

            $controller = ucwords($uri[1]).'Controller';
            $action = (isset($uri[2]) && $uri[2] != '' ) ? $uri[2]."Action" : 'indexAction';
            $params = array();

            for ($i=3; $i < (count($uri)); $i++) {
                array_push($params, $uri[$i]);
            }
            self::$request->url = self::$url;
            $surl = str_replace('/public', '', $_SERVER['REQUEST_URI']);
            $surlArr = explode("/",$surl);
            $surlArr = array_shift($surlArr);
            $surl = implode('/', $surlArr);
            self::$surl = $surl;

            if(strpos($action, '-') !== false) {
                 $action = lcfirst(str_replace('-', '', ucwords($action, '-')));
            }

            $dp->buildAndCallController($controller, $action, $params);

        }

    }

    public static function getBaseURL() {
        return self::$url;
    }

    public static function getURL() {
        return self::$surl;
    }

    public static function getRequest() {
        return self::$request;
    }

}
