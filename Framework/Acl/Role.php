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
    private $denyResources = array();

    public function __construct($name) {
        $this->name = $name;
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

    public function getAllowedResource($name) {
        return $this->allowResources[$name];
    }

}
