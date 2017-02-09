<?php

require_once 'vendor/autoload.php';

use Controllers\Core\Web\Pages;

$test = new Pages();
var_dump($test->render());