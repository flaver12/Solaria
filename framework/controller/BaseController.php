<?php
//by flaver

class BaseController {

    protected $request;

    public function __construct() {
        $this->request = URL::getRequest();
    }

    public function __destruct() {
        Application::singleton('Template')->render();
    }

    protected function set($name, $value) {
        Application::singleton('Template')->set($name, $value);
    }

    protected function view() {
        return Application::singleton('Template');
    }

}
