<?php
/**
+------------------------------------------------------------------------+
| dev-storm.com                                                          |
+------------------------------------------------------------------------+
| Copyright (c) 2014 dev-storm.com Team                                  |
+------------------------------------------------------------------------+
| @author flaver <flaver@dev-storm.com>                                  |
| @copyright flaver, dev-storm.com                                       |
| @package devstorm.services                                             |
| @desc all needed services are here                                     |
+------------------------------------------------------------------------+
 */
 
 use Phalcon\Mvc\Dispatcher;
 use Phalcon\Mvc\View;
 use Phalcon\Mvc\View\Engine\Volt;
 use Phalcon\Mvc\Url;
 use Phalcon\Session\Adapter\Files as SessionManager;
 use Phalcon\Db\Adapter\Pdo\Mysql as DatabaseConnection;
 use devStorm\Library\Mail\Mail;
 use Phalcon\Mvc\Model\Metadata\Files as MetaDataAdapter;
 //Dispatcher
 $di->set('dispatcher', function() {
	$dispatcher = new Dispatcher();
	$dispatcher->setDefaultNamespace('devStorm\Controllers');
	return $dispatcher;
});

//Configure volt 
$di->set('voltService', function($view, $di){
	$volt = new Volt($view , $di);
	$volt->setOptions(
		array(
			'compiledPath' 		=> '../app/cache/views/',
			'compiledExtension'	=> '.compiled',
			'compileAlways'		=> true //Only for development
		)
	);
	return $volt;
});

//Register the view
$di->set('view', function() use($config) {
	$view = new View();
	$view->setViewsDir($config->site->viewsDir);
	$view->registerEngines(array(
        ".volt" => 'voltService'
    ));
    
    return $view;
});

//Url
$di->set('url', function() use($config){
	$url = new Url();
	$url->setBaseUri($config->site->baseUri);
	return $url;	
}, true);

//Router
$di->set('router', function(){
    require '../app/config/router.php';
    return $router;
});

//Session
$di->set('session', function(){
	$session = new SessionManager();
	$session->start();
	return $session;
});

//Session flash
$di->set(
    'flashSession',
    function () {
        return new Phalcon\Flash\Session(array(
            'error'   => 'alert alert-danger',
            'success' => 'alert alert-success',
            'notice'  => 'alert alert-info',
        ));
    }
);

//Config
$di->set('config', $config);

//DB
$di->set('db', function() use($config){
	$db = new DatabaseConnection(
        array(
            'host'      => $config->database->host,
            'username'  => $config->database->username,
            'password'  => $config->database->password,
            'dbname'    => $config->database->dbname
    ));
    return $db;
});

/**
 * Set up the falsh msg with bootstrap
 */
$di->set('flash', function(){
    $flash = new Phalcon\Flash\Direct(array(
        'error'   => 'alert alert-danger',
        'success' => 'alert alert-success',
        'notice'  => 'alert alert-info'
    ));
    return $flash;
});

//Register our email
$di->set('mail', function(){
    return new Mail();
});
$di->set('modelsMetadata', function() use($config) {
    return new MetaDataAdapter(array('metaDataDir' => APP_PATH . '/app/cache/metaData/'));
}, true);
?>