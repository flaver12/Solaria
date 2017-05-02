<?php
/**
*
* Request wrapper class
*
* @author Flavio Kleiber <flaverkleiber@yahoo.de>
* @package FM\Framework\Url
* @copyright 2016-2017 Flavio Kleiber
*/

namespace FM\Framework\Url;

class Request {

    public $url;
    public $arguments;

    /**
    * Check if the request is a post request
    *
    * @return bool
    */
    public function isPost() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            return true;
        }
        return false;
    }

    /**
    * Get the content of the post array
    * if the value is empty you get the post array
    *
    * @param value string
    * @return mixed array|string
    */
    public function getPost($value='') {
        return ($value == '') ?  $_POST :  $_POST[$value];
    }

}
