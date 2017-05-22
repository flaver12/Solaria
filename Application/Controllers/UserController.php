<?php

namespace Solaria\App\Controllers;

use Solaria\Framework\Controller\BaseController;
use Solaria\App\Models\User;

class UserController extends BaseController {

    //profile view
    public function indexAction($id) {
        $user = User::find($id);
        $this->set('profile_user', $user);
    }

}
