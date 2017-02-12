<?php

class Application {

    private static $loadedClasses = array();

    public function __construct($isUnitTest = false) {

        //fix for unit tests
        if(!defined('APP_PATH')) {
            define('APP_PATH', realpath('..'));
        }
        
        //Set url up
        $urlConfig = parse_ini_file(APP_PATH."/config/url.ini", true);
        URL::init($urlConfig);

        //Set template engine up!
        Twig_Autoloader::register();
        $loader = new Twig_Loader_Filesystem(APP_PATH.'/src/view');
        $twig = new Twig_Environment($loader, array(
            'cache' => APP_PATH.'/cache/view',
            'debug' => true,
            'auto_reload ' => true
        ));
        array_push(self::$loadedClasses, array('renderer' => $twig));
    }

    public function run() {
        Session::start();

        //just for phpunit
        if(!isset($_GET['_url'])) {
            $_GET['_url'] = '/';
        }
        URL::resolve($_GET['_url']);
    }

    public static function singelton($className, $params = array()) {

        $instance = array_column(self::$loadedClasses, $className);

        if($instance == array()) {
            if($params == array()) {
                $instance = new $className();
            } else {
                $class = new ReflectionClass($className);
                $instance = $class->newInstanceArgs($params);
            }

            array_push(self::$loadedClasses, array($className => $instance));
        }

        if(is_array($instance)) {
            $instance = $instance[0];
        }

        return $instance;
    }

}
