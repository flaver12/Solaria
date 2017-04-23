<?php

namespace FM\Framework\Acl;

use FM\Framework\Session;
use FM\Framework\Application;

class Acl {

    protected $roles = array();
    protected $user = null;
    protected $usedGroupes = array();

    public function __construct($user = null) {

        if (isset($user)) {
            $this->user = $user;
        } else if(Session::exist('user')) {
            $this->user = Session::get('user')[0];
        } else {
            return false;
        }

        $this->setUpgetRoles($this->user);
    }

    protected function setUpgetRoles($user) {
        $roles = $user->getUserRole();
        foreach($roles as $role) {
            var_dump($role);
            die;
            array_push($this->roles, $role->getRole()->getName());
        }

        //Application::refreshInstance($this);
    }

    public function getRole() {
        return $this->roles;
    }

}
