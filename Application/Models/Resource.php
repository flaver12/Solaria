<?php

namespace Solaria\Application\Models;

use Solaria\Framework\Application\BaseModel;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * @Entity @Table(name="resource")
 **/
class Resource extends BaseModel {

    /** @Id @Column(type="integer") @GeneratedValue **/
    protected $id;

    /** @Column(type="string") **/
    protected $name;

    /**
     * One Role has Many UserRole.
     * @OneToMany(targetEntity="Solaria\App\Models\ResourceRole", mappedBy="resource")
     */
    protected $resourceRole = null;

    public function __construct() {
        $this->resourceRole     = new ArrayCollection();
    }

    public function getId() {
        return $this->id;
    }

    public function getName() {
        return $this->name;
    }

    public function getResourceRole() {
        return $this->resourceRole;
    }

    public function setName($name) {
        $this->name = $name;
    }
}
