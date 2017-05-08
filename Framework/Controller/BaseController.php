<?php
//by flaver

namespace FM\Framework\Controller;

use FM\Framework\Url\Url;
use FM\Framework\Application;
use FM\Framework\Session;
use FM\Framework\Acl\Acl;

class BaseController {

    protected $request;
    protected $view;
    protected $response;
    protected $acl;
    protected $flashSession;

    public function __construct() {
        $this->request = URL::getRequest();
        $this->view = Application::singleton('FM\Framework\View\Template');
        $this->response = Application::singleton('FM\Framework\Url\Response');
        $this->flashSession = Application::singleton('FM\Framework\View\Flash\SessionFlash');
        if(Session::exist('user')) {
            $this->set('user', Session::get('user'));
        }
        $this->acl = new Acl();
    }

    public function __destruct() {
        Application::singleton('FM\Framework\view\Template')->render();
    }

    protected function set($name, $value) {
        Application::singleton('FM\Framework\view\Template')->set($name, $value);
    }

    protected function noRenderer() {
        Application::singleton('FM\Framework\view\Template')->noRenderer();
    }
}
