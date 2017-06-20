<?php
/**
* Simple Di wrapper
*
* @author Flavio Kleiber <flaverkleiber@yahoo.de>
* @copyright 2016-2017 Flavio Kleiber
*/

namespace Solaria\Framework\Core;
use Solaria\Framework\Core\Application;

class DiClass {

    protected $di = "";

    public function __construct() {
        $this->di = Application::$di;
    }

}
