<?php
/**
*
* Response wrapper class
*
* @author Flavio Kleiber <flaverkleiber@yahoo.de>
* @package Solaria\Framework\Url
* @copyright 2016-2017 Flavio Kleiber
*/

namespace Solaria\Framework\Url;

use Solaria\Framework\Url\Url;

class Response {

    /**
    * Redirect to a url
    *
    * @param url string
    * @param statusCode int default is 303
    * @return void
    */
     public static function redirect($url, $statusCode = 303) {
         header('Location: '.URL::getBaseURL().'/'. $url, true, $statusCode);
         die();
     }

}
