<?php
/**
 * Index file all magic happens here
 *
 * @author Flavio Kleiber <flavio.kleiber@gentleman-informatik.ch>
 * @copyright (c) 2014 Flavio Kleiber, Gentleman Informatik
 * @package devstorm.index
 */
error_reporting(E_ALL);
ini_set("display_errors", 1);
ini_set("track_errors", 1);
ini_set("html_errors", 1);

/** DEFINE SOME USES **/
use Phalcon\Mvc\Application;
use Phalcon\Loader;
use Phalcon\DI\FactoryDefault;
use Phalcon\Config\Adapter\Ini as Configreader;

if(!isset($_GET['_url'])) {
    $_GET['_url'] = '/';
}
/** DEFINE MY APP_PATH **/
define("APP_PATH", realpath('..'));

/** READ THE CONFIGS **/
$config 	= new Configreader(APP_PATH.'/app/config/main.ini');
//$db_config		= new Configreader(APP_PATH.'/app/config/db.ini');

/** AUTOLOADER **/
include APP_PATH.'/app/config/loader.php';

//START UP APP
try {
	$di = new FactoryDefault();
	include APP_PATH.'/app/config/services.php';
	$app = new Application($di);
	echo $app->handle()->getContent();
} catch(Exception $e) {
	echo $e->getMessage();
	die;
}
