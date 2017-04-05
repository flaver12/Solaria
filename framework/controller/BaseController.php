<?php
//by flaver

namespace FM\Framework\controller;

use FM\Framework\url\Url;
use FM\Framework\Application;

class BaseController {

    protected $request;

    public function __construct() {
        $this->request = URL::getRequest();
    }

    public function __destruct() {
        Application::singleton('FM\Framework\view\Template')->render();
    }

    protected function set($name, $value) {
        Application::singleton('FM\Framework\view\Template')->set($name, $value);
    }

    protected function view() {
        return Application::singleton('FM\Framework\view\Template');
    }

}
