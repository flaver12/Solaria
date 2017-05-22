<?php
/**
*
* Abstract layer of a resource
*
* @author Flavio Kleiber <flaverkleiber@yahoo.de>
* @package Solaria\Framework\ACL
* @copyright 2016-2017 Flavio Kleiber
*/
namespace Solaria\Framework\Acl;

class Resource {

    private $name;

    public function __construct($name) {
        $this->name = $name;
    }

    public function getName() {
        return $this->name;
    }
}
