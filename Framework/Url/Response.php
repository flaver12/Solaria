<?php
/**
*
* Response wrapper class
*
* @author Flavio Kleiber <flaverkleiber@yahoo.de>
* @package FM\Framework\Url
* @copyright 2016-2017 Flavio Kleiber
*/

namespace FM\Framework\Url;

use FM\Framework\Url\Url;

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
