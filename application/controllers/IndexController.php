<?php

namespace FM\App\controllers;

use FM\Framework\Controller\BaseController;
use FM\App\Models\User;

class IndexController extends BaseController {

    public function indexAction() {
        $this->set('the', 'test!');
        //var_dump($this->acl->getRole());
    }

    public function testAction() {
        printf("Hello world2!");
    }

}
