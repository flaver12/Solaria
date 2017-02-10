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
 | @desc home page                                                        |
 +------------------------------------------------------------------------+
  */
namespace devStorm\Controllers;
use devStorm\Controllers\BaseController;
use devStorm\Models\Post;

 class IndexController extends BaseController {

 	public function indexAction() {
		$this->tag->prependTitle("&hearts; Home - ");
        $online = strtotime("- 30 days");
        $posts = Post::find(array('created >= :minutes:', 'bind' => array('minutes' => $online)));
        if($posts !== false) {
            $this->view->posts = $posts;
        }
	}
 }
?>
