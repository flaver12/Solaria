<?php

namespace FM\App\Models;
use FM\Framework\Model\BaseModel;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * @Entity @Table(name="resource")
 **/
class Resource extends BaseModel {

    /** @Id @Column(type="integer") @GeneratedValue **/
    protected $id;

    /** @Column(type="string") **/
    protected $name;

    /** @Column(type="integer") **/
    protected $permission_id;

    /**
     * Many Users have One UserGroupId.
     * @ManyToOne(targetEntity="FM\App\Models\Permission")
     * @JoinColumn(name="permission_id", referencedColumnName="id")
     */
    protected $permission;

    /**
     * One Role has Many UserRole.
     * @OneToMany(targetEntity="FM\App\Models\ResourceRole", mappedBy="resource_id")
     */
    protected $resourceRole = null;

    public function __construct() {
        $this->permission       = new ArrayCollection();
        $this->resourceRole     = new ArrayCollection();
    }

    public function getId() {
        return $this->id;
    }

    public function getName() {
        return $this->name;
    }

    public function getPermission() {
        return $this->permission;
    }

    public function getResourceRole() {
        return $this->resourceRole;
    }
}
