<?php
//by flaver

class BaseController {

    public function __construct() {

    }

    public function __destruct() {
        Application::singelton('Template')->render();
    }

    protected function set($name, $value) {
        Application::singelton('Template')->set($name, $value);
    }
}
