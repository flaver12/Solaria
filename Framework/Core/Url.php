<?php
/**
* URL class, this will parse the url and then call the dispatcher
*
* @author Flavio Kleiber <flaverkleiber@yahoo.de>
* @package Solaria\Framework
* @copyright 2016-2017 Flavio Kleiber
*/
namespace Solaria\Framework\Core;

use Solaria\Framework\Core\Dispatcher;
use Solaria\Framework\Core\DiClass;

class Url extends DiClass {

    public $urls = array();
    public $url = '';
    public $urlPath = '';

    public function __construct($config) {
        parent::__construct();
        $this->urls = $config;
        $this->urlPath = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
        $this->url  = str_replace('/public', '', $this->urlPath);
        $this->di->set('Url', $this);
    }

    public function resolve($url) {
        $dp = new Dispatcher();

        if (!isset($url) || $url == '/') {
            $dp->dispatch('IndexController', 'indexAction', array());
            return;
        } else {
            $uri = explode("/",$url);
            //check now if we have a config url
            $urlName = strtolower($uri[1]);
            foreach ($this->urls as $name => $settings) {
                if($urlName == $name) {
                    $params = array();
                    for ($i=2; $i < (count($uri)); $i++) {
                        array_push($params, $uri[$i]);
                    }
                    $dp->dispatch(ucwords($settings['controller']).'Controller', $settings['action']."Action", $params);
                    return;
                }
            }
            if($uri[0] == "") {
                $uri = array_splice($uri, 1);
            }

            if(count($uri) == 2 && is_numeric($uri[1])) {
                $param = $uri[1];
                $uri[1] = 'index';
                $uri[2] = $param;
            }

            if(count($uri) == 1) {
                $uri[1] = 'index';
                $uri[2] = 'index';
            }

            $module = ucwords($uri[0]);
            $controller = ucwords($uri[1]).'Controller';
            $action = (isset($uri[2]) && $uri[2] != '' ) ? $uri[2]."Action" : 'indexAction';
            $params = array();

            for ($i=2; $i < (count($uri)); $i++) {
                array_push($params, $uri[$i]);
            }

            if(strpos($action, '-') !== false) {
                 $action = lcfirst(str_replace('-', '', ucwords($action, '-')));
            }

            $dp->dispatch($controller, $action, $params, $module);
        }

    }

}
