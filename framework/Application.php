<?php

namespace FM\Framework;

use \Doctrine\ORM\Tools\Setup;
use \Doctrine\ORM\EntityManager;
use FM\Framework\url\Url;
use ReflectionClass;
use Exception;

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

        //db
        // Create a simple "default" Doctrine ORM configuration for Annotations
        $isDevMode = true;
        $config = Setup::createAnnotationMetadataConfiguration(array(APP_PATH."/application/models"), $isDevMode);

        // database configuration parameters
        $conn = array(
          'driver'   => 'pdo_mysql',
          'user'     => $mainConf['db']['username'],
          'password' => $mainConf['db']['password'],
          'dbname'   => $mainConf['db']['name'],
        );

        // obtaining the entity manager
        $entityManager = EntityManager::create($conn, $config);

        //Set url up
        $urlConfig = parse_ini_file(APP_PATH."/config/url.ini", true);
        URL::init($urlConfig);

        //create acl instance
        self::singleton('FM\Framework\Acl\Acl');

        //set up databases
        //self::singleton('DbCore', array($mainConf['db']['host'],$mainConf['db']['user'], $mainConf['db']['password'], $mainConf['db']['dbname']));

        //Set template engine up!
        \Twig_Autoloader::register();
        $loader = new \Twig_Loader_Filesystem(APP_PATH.'/application/view');
        $twig = new \Twig_Environment($loader, array(
            'cache' => APP_PATH.'/'.$mainConf['view']['cacheDir'],
            'debug' => $mainConf['view']['debug'],
            'auto_reload ' => $mainConf['view']['auto_reload']
        ));

        //save some data
        array_push(self::$loadedClasses, array('view' => $twig));
        array_push(self::$loadedClasses, array('entityManager' => $entityManager));

        self::$mainConf = $mainConf;
    }

    public function run() {

        //start the session
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
            if(empty($params)) {
                $instance = new $className();
            } else {
                //create with params
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

    public static function refreshInstance($instance) {
        if(self::$loadedClasses[get_class($instance)]) {
            self::$loadedClasses[get_class($instance)] = $instance;
            return;
        } else if(strpos(get_class($instance), 'Acl') !== false) {
            self::$loadedClasses['acl'] = $instance;
            return;
        }
        throw new Exception("Don't use refreshInstance to create a new instance, use singleton!");

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
        return get_called_class();
    }

}
