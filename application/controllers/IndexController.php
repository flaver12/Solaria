<?php

namespace FM\App\controllers;

use FM\Framework\controller\BaseController;

class IndexController extends BaseController {

    public function indexAction() {
        $this->view->set('the', 'test!');
    }

    public function testAction() {
        printf("Hello world2!");
    }

}
