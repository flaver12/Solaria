<?php

namespace FM\App\controllers;

use FM\Framework\controller\BaseController;

class IndexController extends BaseController {

    public function indexAction() {
        $this->set('the', 'test!');
    }

    public function testAction() {
        printf("Hello world2!");
    }

}
