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
| @desc userpage                                                         |
+------------------------------------------------------------------------+
 */
namespace devStorm\Controllers;
use devStorm\Controllers\BaseController;
use devStorm\Models\User;

class UserController extends BaseController {

    public function indexAction($username) {
        $this->tag->prependTitle("&hearts; $username - ");
        $user = User::findFirst(array('username = :username:', 'bind' => array('username' => $username)));
        if($user) {
            $this->view->user = $user;
        }
    }

    public function editAction($username) {
        if($this->session->has('auth') && $this->session->get('auth')['username'] == $username) {
            $this->tag->prependTitle("&hearts; $username - ");
            $this->view->auth = $this->session->get('auth');
        } else {
            $this->response->redirect('');
        }
    }

    public function uploadImage() {
        if ($this->request->hasFiles() == true) {
            echo 1; die;
            $baseLocation = APP_PATH.'public/uploads/';
            // Print the real file names and sizes
            foreach ($this->request->getUploadedFiles() as $file) {
                //Move the file into the application
                $file->moveTo($baseLocation . $file->getName());
            }
        }
    }
}
?>
