<?php

namespace FM\App\Models;
use FM\Framework\Model\BaseModel;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * @Entity @Table(name="role")
 **/
class Role extends BaseModel {

    /** @Id @Column(type="integer") @GeneratedValue **/
    protected $id;

    /** @Column(type="string") **/
    protected $name;

    /**
     * One Role has Many UserRole.
     * @OneToMany(targetEntity="FM\App\Models\UserRole", mappedBy="role_id")
     */
    protected $userRoles = null;

    public function __construct() {
        $this->userRoles  = new ArrayCollection();
    }

    public function getId() {
        return $this->id;
    }

    public function getName() {
        return $this->name;
    }

    public function getUserRole() {
        return $this->userRoles;
    }
}
