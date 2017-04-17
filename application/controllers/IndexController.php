<?php

namespace FM\App\controllers;

use FM\Framework\Controller\BaseController;
use FM\Framework\Acl\Acl;
use FM\App\Models\User;

class IndexController extends BaseController {

    public function indexAction() {
        $this->view->set('the', 'test!');
    }

    public function testAction() {
        printf("Hello world2!");
    }

}
