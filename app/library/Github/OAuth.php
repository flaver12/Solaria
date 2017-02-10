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
| @desc oAuth                                                            |
+------------------------------------------------------------------------+
 */
namespace devStorm\Library\Github;
use Phalcon\DI\Injectable;
use Guzzle\Http\Client;

class OAuth extends Injectable {
	
	/**
	* Auth link for GIT 
	* 
	* @var string
	* @access protected
	*/
	protected $auth = "https://github.com/login/oauth/authorize";
	
	/**
	*Accestoken link for GIT 
	* 
	* @var string
	* @access protected
	*/
	protected $accessToken = "https://github.com/login/oauth/access_token";

	/**
	 * ClientID form app
	 * 
	 * @todo  Move to config
	 * @var  string
	 * @access  protected
	 **/
	protected $clientID = "1c8e01859e4093480ac5";

	protected $clientSecret = "30e397c8e5c33fd6e3f89d3fc53b01513528581e";

	
	/**
	* Authorizes a user
	* 
	* @return Phalcon\Http\Response
	*/
	public function _auth(){
		$this->view->disable();
		$key   = $this->security->getTokenKey();
		$token = $this->security->getToken();
		$url = $this->auth."?client_id=". $this->clientID .'&redirect_uri=http://devstorm.eu1.frbit.net/auth/github/accessToken'
		.'&statekey='. $key.'&state='.$token.'&scope=user:email';
		$this->response->redirect($url, true);
	}
	
	/**
	* GIT token
	* 
	* @return
	*/
	public function _token(){
		$key 	= $this->request->getQuery('statekey');
		$value 	= $this->request->getQuery('state');
		//Check oure token
		/*if(!$this->di["security"]->checkToken($key, $value)) {
			return false;
		}*/
		//We dont need any view
		$this->view->disable();
		//Pack the values in array
		$params = array(
			'client_id' 	=> $this->clientID,
			'client_secret'	=> $this->clientSecret,
			'code'          => $this->request->getQuery('code'),
            'state'         => $this->request->getQuery('state')
		);
		//Send the params to git
		$response = $this->send($this->accessToken, $params);
	}
	
	/**
	* GIT send oauth
	* 
	* @param $url url to sen the request
	* @param $params parameters for the request
	* @return boolean|mixed
	*/
	public function send($url, $params){
		try {
			//Create new Guzzle HTTP-Client
			$client = new Client();
			
			//Set headers
			$header = array(
				'Accept' => 'application/json'
			);

			//Send the request
			$request = $client->post($url, $header, $params);

			return json_decode((string)$request->send()->getBody(), true);
		} catch (\Exception $e) {
			return false;
		}
	}
}
?>