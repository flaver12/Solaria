<?php

namespace FM\App\models;
use FM\Framework\model\BaseModel;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * @Entity @Table(name="category")
 **/
class Category extends BaseModel {

    /** @Id @Column(type="integer") @GeneratedValue **/
    protected $id;

    /** @Column(type="string") **/
    protected $name;

    /**
     * @Column(type="datetime")
     * @var DateTime
     */
    protected $created;

    /** @Column(type="integer") **/
    protected $enabled;

    /**
     * One Category has Many Topics.
     * @OneToMany(targetEntity="FM\App\models\Topic", mappedBy="category_id")
     */
    protected $topics = null;

    public function __construct() {
      $this->topics = new ArrayCollection();
    }

    public function setName($name) {
      $this->name = $name;
    }

    public function setCreated($created) {

      $this->created = $created;

    }

    public function setEnabled($enabled) {

      $this->enabled = $enabled;

    }

    public function getName() {
      return $this->name;
    }

    public function getCreated() {
      return $this->created;
    }

    public function getEnabled() {
      return $this->enabled;
    }

    public function getTopics() {
      return $this->topics;
    }
}
