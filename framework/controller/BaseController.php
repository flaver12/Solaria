<?php
//by flaver

namespace FM\Framework\controller;

use FM\Framework\Url\Url;
use FM\Framework\Application;
use FM\Framework\Session;

class BaseController {

    protected $request;
    protected $view;
    protected $response;

    public function __construct() {
        $this->request = URL::getRequest();
        $this->view = Application::singleton('FM\Framework\View\Template');
        $this->response = Application::singleton('FM\Framework\Url\Response');
        if(Session::get('user')) {
            $this->set('user', Session::get('user'));
        }
    }

    public function __destruct() {
        Application::singleton('FM\Framework\view\Template')->render();
    }

    protected function set($name, $value) {
        Application::singleton('FM\Framework\view\Template')->set($name, $value);
    }
}
