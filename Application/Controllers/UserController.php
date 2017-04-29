<?php

namespace FM\App\Controllers;

use FM\Framework\Controller\BaseController;
use FM\App\Models\User;

class UserController extends BaseController {

    //profile view
    public function indexAction($id) {
        $user = User::find($id);
        $this->set('profile_user', $user);
    }

}
