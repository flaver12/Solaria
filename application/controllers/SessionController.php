<?php

class SessionController extends BaseController {

    public function registerUserAction() {

        if($this->request->isPost()) {
            $username = $this->request->getPost('username');
            $password = sha1($this->request->getPost('password'));
            $user =  Application::singleton('User');
            $user->password = $password;
            $user->username = $username;
            $user->save($user);
        } else {
            $this->set('name', 'flaver');
            $this->set('singUpForm', new SingUpForm());
        }

    }

}
