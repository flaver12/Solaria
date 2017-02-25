<?php

class SessionController extends BaseController {

    public function registerUserAction() {

        if($this->request->isPost()) {
            var_dump($_POST);die;
        } else {
            $this->set('name', 'flaver');
            $this->set('singUpForm', new SingUpForm());
        }

    }

}
