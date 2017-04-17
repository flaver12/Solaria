<?php

namespace FM\Framework\Acl;

use FM\Framework\Session;

class Acl {

    protected $roles = array();
    protected $user = null;
    protected $usedGroupes = array();

    public function __construct($user) {

        if (isset($user)) {
            $this->user = $userId;
        } else if(isset(Session::get('user'))) {
            $this->user = Session::get('user');
        } else {
            return false;
        }

        $this->getRoles($user);
    }

    public function getRoles($user) {
        $roles = $user->getUserRoles();

        foreach($roles as $role) {
            array_push($this->usedGroupes, $role->getRole()->getName());
        }
    }

}
