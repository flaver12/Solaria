<?php
/**
*
* Loads all needed data and sets up the acl
*
* @author Flavio Kleiber <flaverkleiber@yahoo.de>
* @package Solaria\Framework\ACL
* @copyright 2016-2017 Flavio Kleiber
*/

namespace Solaria\Framework\Acl;

use Solaria\Framework\Application;
use Solaria\Framework\Acl\Acl;
use Solaria\Framework\Acl\Role;
use Solaria\Framework\Acl\Resource;

use Exception;

class AclDbSetup {

    private $aclConf = null;
    private $acl = null;
    private $user = null;

    public function __construct($userId = null) {
        $this->aclConf = Application::getConfig()['acl'];
        $this->acl = new Acl();
        if ($userId != null) {
            $this->user = $this->aclConf['userTable']::find($userId);
            if(!$this->user) {
                throw new Exception("No user found!");
            }
            $this->loadRoles();
        } else {
            $this->acl->addRole(new Role('Guest'));
        }

        $this->loadResources();
    }

    public function loadRoles() {
        $roles = $this->user->getUserRole();
        foreach ($roles as $role) {
            $currentRole = $role->getRole();
            $extendArray = array();
            while ($currentRole->getExtendId() != 0) {
                $currentRole = $this->aclConf['roleTable']::find($currentRole->getExtendId());
                $extendRole = new Role($currentRole->getName());
                $this->acl->addRole($extendRole);
                $extendArray[] = $extendRole;
            }
            $this->acl->addRole(new Role($role->getRole()->getName(), $extendArray));
        }
    }

    public function loadResources() {
        foreach ($this->acl->getRole() as $role) {
            $role = $this->aclConf['roleTable']::findBy(array('name' => $role->getName()))[0];
            $resourceRoles = $this->aclConf['resourceRolePermissionTable']::findBy(array('role_id' => $role->getId()));
            foreach ($resourceRoles as $resourceRole) {
                $resource = $resourceRole->getResource();
                $this->acl->addResource(new Resource($resource->getName()));
                $resRol = $this->aclConf['resourceRolePermissionTable']::findBy(array('resource_id' => $resource->getId(), 'role_id' => $role->getId()))[0];
                $this->acl->allow($resRol->getRole()->getName(), $resource->getName());
            }
        }
    }

    public function getLoadedAcl() {
        return $this->acl;
    }


}
