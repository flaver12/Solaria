<?php
/**
*
* The application class runs everything
* soo look what you are chaning here
*
* @author Flavio Kleiber <flaverkleiber@yahoo.de>
* @package Solaria\Framework
* @copyright 2016-2017 Flavio Kleiber
*/
namespace Solaria\Framework\Core;

use \Doctrine\ORM\Tools\Setup;
use \Doctrine\ORM\EntityManager;
use Solaria\Framework\Core\Url;
use Solaria\Framework\Core\Session;
use Solaria\Framework\View\Flash\SessionFlash;
use Monolog\Logger;
use Monolog\Handler\StreamHandler;
use DI\ContainerBuilder;
use Exception;

class Application {

    public static $di;

    /**
    * Call the __constrcut only ones, the framework will other wise do some very strange things
    *
    * @return void
    */
    public function __construct() {

        self::$di = ContainerBuilder::buildDevContainer();

        //load main conf
        $mainConf = parse_ini_file(APP_PATH."/config/main.ini", true);
        self::$di->set('mainConf', $mainConf);

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
        self::$di->set('EntityManager', $entityManager);

        // create a log channel
        $log = new Logger('App');
        $log->pushHandler(new StreamHandler(APP_PATH.'/log/app.log', Logger::WARNING));
        self::$di->set('Logger', $log);

        //Set template engine up!
        \Twig_Autoloader::register();
        $loader = new \Twig_Loader_Filesystem(APP_PATH.'/Application');
        $loader->addPath(APP_PATH.'/Application/Page/View', 'Page');
        $loader->addPath(APP_PATH.'/Application/Forum/View', 'Forum');
        $twig = new \Twig_Environment($loader, array(
            'cache' => APP_PATH.'/'.$mainConf['view']['cacheDir'],
            'debug' => $mainConf['view']['debug'],
            'auto_reload ' => $mainConf['view']['auto_reload']
        ));
        self::$di->set('View', $twig);
        self::$di->set('Modules', array(
            'Page','Forum'
        ));

    }

    /**
    * Starts the session und the dispatching
    *
    * @return void
    */
    public function run() {
        $session = new Session();
        self::$di->set('Session', $session);
        self::$di->set('Application', $this);
        self::$di->set('SessionFlash', new SessionFlash());
        $urlConfig = parse_ini_file(APP_PATH."/config/url.ini", true);
        $url = new Url($urlConfig);
        $url->resolve($_GET['_url']);
    }

    /**
    * Get caller class
    *
    * @deprecated
    */
    public function getCaller() {
        return get_called_class();
    }

}
