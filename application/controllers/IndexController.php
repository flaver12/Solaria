<?php

class IndexController extends BaseController {

    public function indexAction() {
        $this->set('the', 'test!');
    }

    public function testAction() {
        printf("Hello world2!");
    }

}
