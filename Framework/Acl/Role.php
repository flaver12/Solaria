<?php
/**
*
* Abstarct layer of a role
*
* @author Flavio Kleiber <flaverkleiber@yahoo.de>
* @package Solaria\Framework\ACL
* @copyright 2016-2017 Flavio Kleiber
*/
namespace Solaria\Framework\Acl;

use Solaria\Framework\Acl\Acl;

class Role {

    private $name;
    private $allowResources = array();

    public function __construct($name, $extends = array()) {
        $this->name = $name;

        if(!empty($extends)) {
            foreach ($extends as $extend) {
                $this->allowResources = $this->allowResources + $extend->getAllowedResource();
            }
        }

    }

    public function getName() {
        return $this->name;
    }

    public function addResource($resource, $mod) {

        if($mod == Acl::ALLOW) {
            $this->allowResources[$resource['name']] = $resource['permission'];
        } else if($mod == Acl::DENY) {
            $this->denyResources[$resource['name']] = $resource['permission'];
        }

    }

    public function getAllowedResource($name = '') {
        if($name == '') {
            return $this->allowResources;
        }
        return $this->allowResources[$name];
    }

}
