<?php

class Request {

    public $url;
    public $arguments;

    public function isPost() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            return true;
        }
        return false;
    }

}
