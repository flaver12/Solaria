<?php

namespace FM\Framework\Acl;

use FM\Framework\Session;
use FM\Framework\Application;
use FM\App\Models\User;
use FM\App\Models\Role;

class Acl {


    const ALLOW = 'allow';
    const FORBID = 'forbid';
    protected $roles = array();
    protected $user = null;
    protected $usedGroupes = array();

    public function __construct($user = null) {

        if (isset($user)) {
            $this->user = $user;
        } else if(Session::exist('user')) {
            $this->user = Session::get('user');
        } else {
            $this->user = null;
            return false;
        }

        //fix for some stupid session fails!
        if(is_bool($this->user)) {
            return false;
        }

        $this->user = User::find($this->user->getId());

        $this->setUpgetRoles($this->user);
    }

    protected function setUpgetRoles($user) {
        $roles = $user->getUserRole();
        foreach($roles as $role) {
            foreach ($role->getRole()->getRolePermission() as $rolePermission) {
                $this->roles[$role->getRole()->getName()][$rolePermission->getPermission()->getName()] = self::ALLOW;
            }
        }

        //Application::refreshInstance($this);
    }

    public function getRole() {
        return $this->roles;
    }

    public function isAdmin() {
        if(isset($this->getRole()['admin'])) {
            return true;
        } else {
            return false;
        }
    }

    public function hasPermission($result) {
        foreach ($result as $resource) {
            $permission = $resource->getPermission();
            if(is_null($permission)) {
                return true;
            }
            if(is_null($this->user)) {
                return false;
            }
            $neddedPermission = $permission->getName();
            foreach ($this->getRole() as $permissions) {
                foreach ($permissions as $permission => $value) {
                    if($permission == $neddedPermission && $value == self::ALLOW) {
                        return true;
                    }
                }
            }
        }
        return false;
    }

}
