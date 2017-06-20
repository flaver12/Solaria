<?php
use Solaria\Framework\Core\Application;

/*
* Farming manager index class
*/
define("APP_PATH", realpath('..'));
//error_reporting(0);

$_GET['_url'] = isset($_GET['_url']) ? $_GET['_url']: '/';

//composer!!!
require_once APP_PATH . '/vendor/autoload.php';

try {
    $app = new Application();
    $app->run();
} catch (Exception $e) {
    echo "FM-ERROR:<br />";
    echo $e->getMessage();
    echo "<br />";
    echo "<pre>";
    echo $e->getTraceAsString();
    echo "</pre>";
}
