<?php
namespace FM\App\controllers;

use FM\Framework\controller\BaseController;
use FM\App\forms\SingUpForm;
use FM\App\models\User;
use FM\Framework\Application;

class SessionController extends BaseController {

    public function registerUserAction() {

        if($this->request->isPost()) {
            $username = $this->request->getPost('username');
            $password = sha1($this->request->getPost('password'));

            $user = new User();
            $user->setUsername($username);
            $user->setPassword($password);

            $entityManager = Application::singleton('entityManager');
            $entityManager->persist($user);
            $entityManager->flush();

        } else {
            $this->set('name', 'flaver');
            $this->set('singUpForm', new SingUpForm());
        }

    }

}
