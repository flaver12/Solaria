<?php

namespace FM\App\Models;
use FM\Framework\Model\BaseModel;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * @Entity @Table(name="resource_role")
 **/
class ResourceRole extends BaseModel {

    /** @Id @Column(type="integer") @GeneratedValue **/
    protected $id;

    /** @Column(type="integer") **/
    protected $resource_id;

    /** @Column(type="integer") **/
    protected $role_id;

    /**
     * Many Users have One UserGroupId.
     * @ManyToOne(targetEntity="FM\App\Models\Role")
     * @JoinColumn(name="role_id", referencedColumnName="id")
     */
     protected $role;

     /**
      * Many Users have One UserGroupId.
      * @ManyToOne(targetEntity="FM\App\Models\Resource")
      * @JoinColumn(name="resource_id", referencedColumnName="id")
      */
     protected $resource;

     public function __construct() {
       $this->resource  = new ArrayCollection();
       $this->role      = new ArrayCollection();
     }

     public function getResource() {
         return $this->resource;
     }

     public function getRole() {
         return $this->role;
     }

     public function getRoleId() {
         return $this->role_id;
     }
}
