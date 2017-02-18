<?php
//by flaver

class BaseController {

    protected $request;

    public function __construct() {
        $this->request = URL::getRequest();
    }

    public function __destruct() {
        Application::singelton('Template')->render();
    }

    protected function set($name, $value) {
        Application::singelton('Template')->set($name, $value);
    }

}
