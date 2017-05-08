<?php

namespace FM\App\Controllers;

use FM\Framework\Controller\BaseController;
use FM\App\Models\User;

class IndexController extends BaseController {

    public function indexAction() {
        $this->set('the', 'test!');

        if($this->request->isAjax()) {
            $this->noRenderer();
            $arr = array('a' => 1, 'b' => 2, 'c' => 3, 'd' => 4, 'e' => 5);

            echo json_encode($arr);die;
        }
    }

    public function testAction() {
        printf("Hello world2!");
    }

}
