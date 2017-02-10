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
 | @desc Error page                                                       |
 +------------------------------------------------------------------------+
 */
namespace devStorm\Controllers;
use devStorm\Controllers\BaseController;

 class ErrorController extends BaseController {

 	public function notFound404Action() {
		$this->tag->prependTitle("&hearts; Error 404 - ");
	}
 }
?>
