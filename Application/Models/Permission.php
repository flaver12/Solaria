<?php

namespace Solaria\Application\Models;

use Solaria\Framework\Application\BaseModel;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * @Entity @Table(name="permission")
 **/
class Permission extends BaseModel {

    /** @Id @Column(type="integer") @GeneratedValue **/
    protected $id;

    /** @Column(type="string") **/
    protected $name;

    /**
     * One Role has Many UserRole.
     * @OneToMany(targetEntity="Solaria\App\Models\RolePermission", mappedBy="permission")
     */
    protected $rolePermission = null;

    /**
     * One Role has Many UserRole.
     * @OneToMany(targetEntity="Solaria\App\Models\Resource", mappedBy="permission_id")
     */
    protected $resourcePermission = null;

    public function __construct() {
        $this->rolePermission  = new ArrayCollection();
        $this->resourcePermission   = new ArrayCollection();
    }

    public function getId() {
        return $this->id;
    }

    public function getName() {
        return $this->name;
    }

    public function getRolePermission() {
        return $this->rolePermission;
    }
    public function getResourcePermission() {
        return $this->resourcePermission;
    }
}
