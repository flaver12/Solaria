<?php
/**
* Session warpper
*
* @author Flavio Kleiber <flaverkleiber@yahoo.de>
* @copyright 2016-2017 Flavio Kleiber
*/

namespace Solaria\Framework\Core;

class Session  {

    public function __construct() {
        session_start();
    }

    public function set($name, $value) {
        $_SESSION['Solaria'][$name] = $value;
    }
    public function get($name) {
        if(isset($_SESSION['Solaria'][$name]))
            return $_SESSION['Solaria'][$name];
        else
            return false;
    }
    public function exist($name) {
        if(isset($_SESSION['Solaria'][$name]))
            return true;
        else
            return false;
    }
    public function delete($name) {
        if(isset($_SESSION['Solaria'][$name]))
            unset($_SESSION['Solaria'][$name]);
        else
            return false;
    }

}
