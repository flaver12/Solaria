<?php

namespace FM\App\controllers;

use FM\Framework\Controller\BaseController;
use FM\App\Models\User;
        use FM\App\Models\Resource;

class IndexController extends BaseController {

    public function indexAction() {
        $this->set('the', 'test!');
    }

    public function testAction() {
        printf("Hello world2!");
    }

}
