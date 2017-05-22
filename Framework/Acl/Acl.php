<?php
/**
*
* Main acl class it handels all the operation
*
* @author Flavio Kleiber <flaverkleiber@yahoo.de>
* @package Solaria\Framework\ACL
* @copyright 2016-2017 Flavio Kleiber
*/

namespace Solaria\Framework\Acl;

use Solaria\Framework\Acl\Role;
use Solaria\Framework\Application;

class Acl {

    const READ      = 'read';
    const WRITE     = 'write';
    const UPDATE    = 'update';
    const DELETE    = 'delete';
    const ALLOW     = 1;
    const DENY      = 0;

    private $defaultAction = Acl::DENY;
    private $role = array();
    private $resources = array();
    private $userRole = null;

    public function setDefaultAction($action) {
        $this->defaultAction = $action;
    }

    public function addRole(Role $role) {
        $this->role[$role->getName()] = $role;
    }

    public function getRole() {
        return $this->role;
    }

    public function addResource(Resource $resource) {
        $this->resources[$resource->getName()] = $resource;
    }

    public function allow($role, $resource) {
        $this->setPermission($role, $resource, array(), self::ALLOW);
    }

    public function deny($role, $resource) {
        $this->setPermission($role, $resource, array(), self::DENY);
    }

    private function setPermission($role, $resource, $permission, $mod) {
        $role = $this->role[$role];
        $resourceArr = array('name' => $resource, 'permission' => true);
        $role->addResource($resourceArr, $mod);
    }

    public function isAllowed($role, $resource) {
        if(!empty($this->role[$role])) {
            $role = $this->role[$role];
            if(!empty($role->getAllowedResource($resource))) {
                return self::ALLOW;
                /*
                if(is_array($permissions)) {
                    foreach ($resource as $rper) {
                        if($permission == $rper) {
                            return self::ALLOW;
                        }
                    }

                } else {
                    if($permissions == $permission) {
                        return self::ALLOW;
                    }
                }*/
            }
        }


        return $this->defaultAction;
    }


}
