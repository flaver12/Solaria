<?php
/**
+------------------------------------------------------------------------+
| dev-storm.com                                                          |
+------------------------------------------------------------------------+
| Copyright (c) 2014 dev-storm.com Team                                  |
+------------------------------------------------------------------------+
| @author flaver <flaver@dev-storm.com>                                  |
| @copyright flaver, dev-storm.com                                       |
| @package devstorm.router                                               |
| @desc routes                                                           |
+------------------------------------------------------------------------+
 */
use \Phalcon\Mvc\Router;

$router = new Router(false);


$router->add('/forum', array(
	'controller' => 'forum',
	'action'	=> 'index'
));

$router->add('/forum/view-thread/:params', array(
    'controller' => 'forum',
    'action'	=> 'thread',
    'params'    => 1
));

$router->add('/forum/create/:params', array(
    'controller' => 'forum',
    'action'	=> 'create',
    'params'    => 1
));

$router->add('/forum/replay/:params', array(
    'controller' => 'forum',
    'action'	=> 'replay',
    'params'    => 1
));

$router->add(
    '/forum/view-post/:params', array(
        'controller' => 'forum',
        'action'	=> 'viewPost',
        'params'    => 1
    )
);

$router->add('/register', array(
	'controller' => 'session',
	'action'	=> 'registerUser'
));

$router->add('/login', array(
	'controller' => 'session',
	'action'	=> 'login'
));

$router->add('/logout', array(
    'controller' => 'session',
    'action'	=> 'logout'
));
$router->add('/auth/github/authUser', array(
	'controller' => 'session',
	'action'	=> 'registerGit'
));

$router->add('/auth/github/accessToken', array(
	'controller' => 'session',
	'action'	=> 'accessToken'
));

$router->add(
    '/confirm/:params',
    array(
        'controller'    => 'session',
        'action'        => 'confirm',
        'params'        => 1
    )
);

$router->add(
    '/member/:params',
    array(
        'controller'    => 'user',
        'action'        => 'index',
        'params'        => 1
    )
);

$router->add(
    '/profile/edit/:params',
    array(
        'controller'    => 'user',
        'action'        => 'edit',
        'params'        => 1
    )
);

$router->add(
    '/profile/upload',
    array(
        'controller'    => 'user',
        'action'        => 'imageUpload'
    )
);
/*
$router->notFound(array(
        "controller" => "error",
        "action" => "notFound404"
));*/
?>
