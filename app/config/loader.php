<?php
/**
+------------------------------------------------------------------------+
| dev-storm.com                                                          |
+------------------------------------------------------------------------+
| Copyright (c) 2014 dev-storm.com Team                                  |
+------------------------------------------------------------------------+
| @author flaver <flaver@dev-storm.com>                                  |
| @copyright flaver, dev-storm.com                                       |
| @package devstorm.loader                                               |
| @desc class loader                                                     |
+------------------------------------------------------------------------+
 */
 
 /** DEFINE SOME USES **/
 use Phalcon\Loader;
 
 /** COMPOSER BABY!! **/
include '../vendor/autoload.php';

//Create a new loader
$loader = new Loader();

//Check for config
if(!isset($config)) {
	$config = new Phalcon\Config\Adapter\Ini('main.ini');
}

//Register the needed namespace's
$loader->registerNamespaces(array(
	'devStorm\Controllers'		=> $config->site->controllersDir,
	'devStorm\Models'			=> $config->site->modelsDir,
	'devStorm\Forms'			=> '../app/forms',
	'devStorm\Library\Github'	=> '../app/library/Github',
	'devStorm\Library\Error'	=> '../app/library/Errors',
	'devStorm\Library\Mail'		=> '../app/library/Mail',
    'devStorm\Library\BBCode'   => '../app/library/BBCode'
));
 
//Register now!
$loader->register();

?>