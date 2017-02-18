<?php

class IndexController extends BaseController {

    public function indexAction() {
        $this->set('the', 'test!');
        $model = Application::singelton('User');
    }

    public function testAction() {
        printf("Hello world2!");
    }

}
