<?php

class Application {

    private static $loadedClasses = array();
    private static $mainConf = null;

    public function __construct($isUnitTest = false) {

        //fix for unit tests
        if(!defined('APP_PATH')) {
            define('APP_PATH', realpath('..'));
        }

        //load main conf
        $mainConf = parse_ini_file(APP_PATH."/config/main.ini", true);

        //Set url up
        $urlConfig = parse_ini_file(APP_PATH."/config/url.ini", true);
        URL::init($urlConfig);

        //set up databases
        self::singleton('DbCore', array($mainConf['db']['host'],$mainConf['db']['user'], $mainConf['db']['password'], $mainConf['db']['dbname']));

        //Set template engine up!
        Twig_Autoloader::register();
        $loader = new Twig_Loader_Filesystem(APP_PATH.'/application/view');
        $twig = new Twig_Environment($loader, array(
            'cache' => APP_PATH.'/'.$mainConf['view']['cacheDir'],
            'debug' => $mainConf['view']['debug'],
            'auto_reload ' => $mainConf['view']['auto_reload']
        ));
        array_push(self::$loadedClasses, array('view' => $twig));

        self::$mainConf = $mainConf;
    }

    public function run() {
        Session::start();

        //just for phpunit
        if(!isset($_GET['_url'])) {
            $_GET['_url'] = '/';
        }
        URL::resolve($_GET['_url']);
    }

    public static function singleton($className, $params = array()) {

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

    public static function newInstance($className, $params = array()) {
        if($params == array()) {
            $instance = new $className();
        } else {
            $class = new ReflectionClass($className);
            $instance = $class->newInstanceArgs($params);
        }

        return $instance;
    }

    public static function purgeCache() {
        if (is_dir(self::$mainConf['view']['cacheDir'])) {
            $objects = scandir(self::$mainConf['view']['cacheDir']);
            foreach ($objects as $object) {
                if ($object != "." && $object != "..") {
                    if (is_dir(self::$mainConf['view']['cacheDir']."/".$object))
                        rmdir(self::$mainConf['view']['cacheDir']."/".$object);
                    else
                        unlink(self::$mainConf['view']['cacheDir']."/".$object);
                }
            }
         //rmdir(self::$mainConf['view']['cacheDir']);
        }
    }

    public static function getCaller() {
        return debug_backtrace()[2]['class'];
    }

}
