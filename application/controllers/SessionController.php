<?php

class SessionController extends BaseController {

    public function registerUserAction() {

        if($this->request->isPost()) {

        } else {
            $this->set('name', 'flaver');
        }

    }

}
