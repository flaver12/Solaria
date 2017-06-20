<?php

namespace Solaria\Application\Page\Controllers;

use Solaria\Framework\Application\BaseController;

class IndexController extends BaseController {

    public function indexAction() {
        $this->view->set('test', 'value');
    }

}
