<?php
namespace Solaria\Framework;

class Session {

    public static function start() {
        session_start();
    }

    public static function destroy() {
        session_destroy();
    }

    public static function set($name, $value) {
        $_SESSION['Solaria'][$name] = $value;
    }

    public static function get($name) {
        if(isset($_SESSION['Solaria'][$name]))
            return $_SESSION['Solaria'][$name];
        else
            return false;
    }

    public static function exist($name) {
        if(isset($_SESSION['Solaria'][$name]))
            return true;
        else
            return false;
    }

    public static function delete($name) {
        if(isset($_SESSION['Solaria'][$name]))
            unset($_SESSION['Solaria'][$name]);
        else
            return false;
    }

}
