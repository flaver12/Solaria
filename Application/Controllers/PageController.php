<?php

namespace Solaria\App\Controllers;

use Solaria\Framework\Controller\BaseController;
use Solaria\App\Models\Page;

class PageController extends BaseController {

    public function indexAction($id) {
        $page = Page::find($id);
        $this->set('page', $page);
    }

}
