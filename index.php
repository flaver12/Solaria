<?php
/*
* Farming manager index class
*/
define("APP_PATH", realpath('.'));

$_GET['_url'] = isset($_GET['_url']) ? $_GET['_url']: '/';

//composer!!!
require_once APP_PATH . '/vendor/autoload.php';

$app = new Application();
$app->run();
