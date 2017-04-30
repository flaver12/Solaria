<?php
/**
*
* The application class runs everything
* soo look what you are chaning here
*
* @author Flavio Kleiber <flaverkleiber@yahoo.de>
* @package FM\Framework
* @copyright 2016-2017 Flavio Kleiber
*/
namespace FM\Framework;

use \Doctrine\ORM\Tools\Setup;
use \Doctrine\ORM\EntityManager;
use FM\Framework\Url\Url;
use Monolog\Logger;
use Monolog\Handler\StreamHandler;
use ReflectionClass;
use Exception;

class Application {

    /**
    * @var array contains all objs of the singleton fnc
    */
    private static $loadedClasses = array();

    /**
    * @var array contains the content of the main.ini conf
    */
    private static $mainConf = null;

    /**
    * Call the __constrcut only ones, the framework will other wise do some very strange things
    *
    * @param bool isUnitTest only used when you want to run the app in a unit test mod
    * @return void
    */
    public function __construct($isUnitTest = false) {

        //fix for unit tests
        if(!defined('APP_PATH')) {
            define('APP_PATH', realpath('..'));
        }

        //load main conf
        $mainConf = parse_ini_file(APP_PATH."/config/main.ini", true);
        self::$mainConf = $mainConf;

        //db
        // Create a simple "default" Doctrine ORM configuration for Annotations
        $isDevMode = true;
        $config = Setup::createAnnotationMetadataConfiguration(array(APP_PATH."/Application/Models"), $isDevMode);

        // database configuration parameters
        $conn = array(
          'driver'   => 'pdo_mysql',
          'user'     => $mainConf['db']['username'],
          'password' => $mainConf['db']['password'],
          'dbname'   => $mainConf['db']['dbname'],
        );

        // obtaining the entity manager
        $entityManager = EntityManager::create($conn, $config);

        //Set url up
        $urlConfig = parse_ini_file(APP_PATH."/config/url.ini", true);
        Url::init($urlConfig);

        // create a log channel
        $log = new Logger('App');
        $log->pushHandler(new StreamHandler(APP_PATH.'/log/app.log', Logger::WARNING));

        //Set template engine up!
        \Twig_Autoloader::register();
        $loader = new \Twig_Loader_Filesystem(APP_PATH.'/Application/View');
        $twig = new \Twig_Environment($loader, array(
            'cache' => APP_PATH.'/'.$mainConf['view']['cacheDir'],
            'debug' => $mainConf['view']['debug'],
            'auto_reload ' => $mainConf['view']['auto_reload']
        ));

        //save some data
        array_push(self::$loadedClasses, array('view' => $twig));
        array_push(self::$loadedClasses, array('entityManager' => $entityManager));
        array_push(self::$loadedClasses, array('logger' => $log));
    }

    /**
    * Starts the session und the dispatching
    *
    * @return void
    */
    public function run() {

        //start the session
        Session::start();

        //just for phpunit
        if(!isset($_GET['_url'])) {
            $_GET['_url'] = '/';
        }
        Url::resolve($_GET['_url']);
    }

    /**
    * Creates or loads a instance of a class
    * use this one when ever possible
    *
    * @example Application::singleton('My\Foo\Bar', array('firstParam', 2, true));
    * @var string className name of the class with the namespace
    * @var array params if the class needs params to be created the can be given here
    * @return Object
    */
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

    /**
    * U can refresh a instance, that is saved in the obj array.
    * Dont use it to create a new instacne
    *
    * @example Application::refreshInstance($myFooBarInstance);
    * @var Instane instance class instance
    * @return void
    */
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

    /**
    * Clenas the view cache
    *
    * @deprecated
    */
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

    /**
    * Get caller class
    *
    * @deprecated
    */
    public static function getCaller() {
        return get_called_class();
    }

    public static function getConfig() {
        return self::$mainConf;
    }

}
