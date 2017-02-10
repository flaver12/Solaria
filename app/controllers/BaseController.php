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
 | @desc Basic Controller for all controllers                             |
 +------------------------------------------------------------------------+
*/
namespace devStorm\Controllers;
use devStorm\Library\Error\Notification;
use devStorm\Models\User;

class BaseController extends \Phalcon\Mvc\Controller {

    /**
     * Init function
     *
     * @return void
     */
	public function initialize() {
		$this->tag->setTitle("devStorm");
        $this->loadOnlineUser();
	}

    /**
     * Returns the last online user
     *
     * @return void
     */
    private function loadOnlineUser() {
        $user = User::find('online = 1');
        if($user !== false) {
            $this->view->onlineUser = $user;
        }
    }
    
}

?>
