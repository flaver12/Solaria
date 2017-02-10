<?php
/**
+------------------------------------------------------------------------+
| dev-storm.com                                                          |
+------------------------------------------------------------------------+
| Copyright (c) 2014 dev-storm.com Team                                  |
+------------------------------------------------------------------------+
| @author flaver <flaver@dev-storm.com>                                  |
| @copyright flaver, dev-storm.com                                       |
| @package devstorm.controllers                                          |
| @desc chatpage                                                         |
+------------------------------------------------------------------------+
 */
namespace devStorm\Controllers;
use devStorm\Controllers\BaseController;

class ChatController extends BaseController {

    public function indexAction() {
        $this->tag->prependTitle("&hearts; Chat - ");
        if(!$this->session->has('auth')) {
            $this->response->redirect('login');
        }
        if($this->request->isAjax() && $this->request->isPost()) {
        }
    }

    public function chatAction() {
        $this->tag->prependTitle("&hearts; Chat - ");

    }
}
?>