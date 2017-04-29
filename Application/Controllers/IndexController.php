<?php

namespace FM\App\Controllers;

use FM\Framework\Controller\BaseController;
use FM\App\Models\User;

class IndexController extends BaseController {

    public function indexAction() {
        $this->set('the', 'test!');
    }

    public function testAction() {
        printf("Hello world2!");
    }

}
