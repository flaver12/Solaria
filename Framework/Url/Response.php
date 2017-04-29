<?php

namespace FM\Framework\Url;

use FM\Framework\Url\Url;

class Response {

  public static function redirect($url, $statusCode = 303) {
      header('Location: '.URL::getBaseURL().'/'. $url, true, $statusCode);
      die();
  }

}
