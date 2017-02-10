<?php
/**
+------------------------------------------------------------------------+
| dev-storm.com                                                          |
+------------------------------------------------------------------------+
| Copyright (c) 2014 dev-storm.com Team                                  |
+------------------------------------------------------------------------+
| @author flaver <flaver@dev-storm.com>                                  |
| @copyright flaver, dev-storm.com                                       |
| @package devstorm.github                                               |
| @desc user object                                                      |
+------------------------------------------------------------------------+
 */

namespace devStorm\Library\Github;
 
 class User{
 	
 	/**
 	 * Github API URL
 	 */
 	private $url = 'https://api.github.com';

 	private $accessToken = null;

 	private $response = null;

 	public function __construct($accessToken) {
 		$this->accessToken = $accessToken;
 		//$this->response = 
 	}

 	public function request($method) {
 		try {
 			$client = new HttpClient();
            return json_decode((string)$client->get($this->url . $method . '?access_token=' . $this->accessToken)->send()->getBody(),true);
 		} catch (\Exception $e) {
 			return false;
 		}
 	}

 	public function isValid() {
 		return is_array($this->response);
 	}
 }
 
?>