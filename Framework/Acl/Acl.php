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

    private $defaultAction = Acl::ALLOW;
    private $roles = array();
    private $resources = array();

    public function setDefaultAction($action) {
        $this->defaultAction = $action;
    }

    public function addRole(Role $role) {
        $this->roles[$role->getName()] = $role;
    }

    public function addResource(Resource $resource) {
        $this->resources[$resource->getName()] = $resource;
    }

    public function allow($role, $resource, $permission) {
        $this->setPermission($role, $resource, $permission, self::ALLOW);
    }

    public function deny($role, $resource, $permission) {
        $this->setPermission($role, $resource, $permission, self::DENY);
    }

    private function setPermission($role, $resource, $permission, $mod) {
        $role = $this->roles[$role];
        $resourceArr = array('name' => $resource, 'permission' => $permission);
        $role->addResource($resourceArr, $mod);
    }

    public function isAllowed($role, $resource, $permission) {
        $role = $this->roles[$role];

        if(!empty($role->getAllowedResource($resource))) {
            $permissions = $role->getAllowedResource($resource);
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
            }

            return self::DENY;
        }

        return self::DENY;
    }


}
