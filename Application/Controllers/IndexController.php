<?php

namespace Solaria\App\Controllers;

use Solaria\Framework\Controller\BaseController;
use Solaria\Framework\Session;

class IndexController extends BaseController {

    public function indexAction() {
        echo Session::get('user')->getUserRole()->getRole()->getName();
    }

}
