<?php

class Session {

    public static function start() {
        session_start();
    }

    public static function destroy() {
        session_destroy();
    }

    public static function set($name, $value) {
        $_SESSION['fm'][$name] = $value;
    }

    public static function get($name) {
        return $_SESSION['fm'][$name];
    }

}
