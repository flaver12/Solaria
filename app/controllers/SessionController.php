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
 | @desc register and login stuff                                         |
 +------------------------------------------------------------------------+
  */
namespace devStorm\Controllers;
use devStorm\Controllers\BaseController;
use devStorm\Library\Github\OAuth;
use devStorm\Forms\RegisterForm;
use devStorm\Library\Error\Notification;
use devStorm\Models\User;

 class SessionController extends BaseController {

 	/**
 	 * @var  CONSTANT
 	 * @desc Defualt redirect (index page)
 	 */
 	const DEFAULT_REDIRECT = "";

 	/**
 	 * Redirect's you to the forum
 	 *
 	 * @return  \Phalcon\Http\ResponseInterface
 	 */
 	private function backToForum() {
 		return $this->response->redirect('');
 	}

 	/**
 	 * Register a new user via Github
 	 *
 	 * @access  public
 	 * @return  \Phalcon\Http\ResponseInterface
 	 */
 	public function registerGitAction() {
 		if(!$this->session->has('auth')) {
 			$oAuth = new OAuth();
 			return $oAuth->_auth();
 		}
 	}

 	public function accessTokenAction() {
 		$oAuth = new OAuth();
 		$response = $oAuth->_token();
 		//Check response from github
 		//If we dont have a array then we have a problem
 		if(is_array($response)){
 			//Have we a error?
 			if(isset($response['error'])) {
 				$this->flashSession->error("Github Error: ".$response['error']);
 				return $this->backToForum();
 			}
 		} else {
 			$this->flashSession->error(Notification::ERROR_GITHUB_PROBLEM);
 			return $this->backToForum();
 		}
 	}

     /**
      * Register a user for a normal account
      */
     public function registerUserAction() {
 		$this->tag->prependTitle("&hearts; Neuer Member - ");
 		$form = new RegisterForm();
 		if($this->request->isPost()) {
 			if($form->isValid($this->request->getPost()) != false) {
 				$user = User::findFirst(array('username = :username:' , 'bind' => array('username' =>$this->request->getPost('username'))));
 				if(isset($user->username) && $user->username != null) {
 					$msg = preg_replace('/###username###/', $this->request->getPost('username'), Notification::ERROR_USER_ALLREADY_EXISTS);
 					$this->flashSession->error($msg);
 				} else {
                    $user = User::findFirst(array('email = :email:' , 'bind' => array('email' =>$this->request->getPost('email'))));
                    if(isset($user->email) && $user->email != null) {
                        $msg = preg_replace('/###email###/', $this->request->getPost('email'), Notification::ERROR_EAMIL_ALLREADY_EXISTS);
                        $this->flashSession->error($msg);
                    } else {
                        $forumUser = new User();
                        $forumUser->username = $this->request->getPost('username', 'striptags');
                        $forumUser->password = sha1($this->request->getPost('password1'));
                        $forumUser->email = $this->request->getPost('email');
                        $forumUser->created = time();
                        $forumUser->validated = 0;
                        $forumUser->banned = 'n';
                        $forumUser->online = 0;
                        if($forumUser->create() == true) {
                            $this->flashSession->success("Wir haben deinen User erfolgreich erstellt. Eine bestätigungs Email ist auf dem weg!");
                        } else {
                            foreach ($forumUser->getMessages() as $message) {
                                echo $message, "\n";
                            }die;
                        }
                    }
 				}
 			}
 		}
 		$this->view->form = $form;
 	}

     /**
      * Login a user with the devstorm account
      */
     public function loginAction() {
 		if($this->request->isPost()) {
 			$password = sha1($this->request->getPost('password'));
            $username = $this->request->getPost('username');
            $user = User::findFirst(array(
                'username = :username: AND password = :password:',
                'bind' => array(
                    'username' => $username,
                    'password' =>$password
                )
            ));
            if($user !== false) {
                $this->session->set('auth', array('id' => $user->id, 'username' => $username, 'email' => $user->email, 'created' => $user->created, 'group' => $user->group_id));
                $user->last_time_online = time();
                $user->online = 1;
                $user->update();
                $this->response->redirect('');
            } else {
                $this->flashSession->error("We found no user!");
            }
 		}
 	}

     /**
      * Confirm the email adress
      *
      * @param null $hash
      * @param null $email
      */
     public function confirmAction($hash=null, $email=null) {
        if(is_null($hash) && is_null($email)) {
            $this->response->redirect('');
        } else {
            if($hash == md5($email)) {
                $user = User::findFirst(array('email = :email:', 'bind' => array('email' => $email)));
                $user->validated = 1;
                if($user->update() == true) {
                    $this->flashSession->success("Dein User wurde erfolgreich validiert!");
                }
            } else {
                $this->flashSession->error(Notification::ERROR_OOPS);
            }
        }
    }

     /**
      * Logs a user out
      */
     public function logoutAction() {
        if($this->session->has('auth')) {
            $this->session->remove('auth');
            $this->response->redirect('');
        }
    }
 }

 ?>
