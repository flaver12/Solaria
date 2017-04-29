<?php

namespace FM\App\models;
use FM\Framework\model\BaseModel;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * @Entity @Table(name="topic")
 **/
class Topic extends BaseModel {

  /** @Id @Column(type="integer") @GeneratedValue **/
  protected $id;

  /** @Column(type="string") **/
  protected $name;

  /** @Column(type="integer") **/
  protected $enabled;

  /** @Column(type="integer") **/
  protected $category_id;

 /**
  * Many Topics have One Category.
  * @ManyToOne(targetEntity="FM\App\Models\Category")
  * @JoinColumn(name="category_id", referencedColumnName="id")
  */
  protected $category;

  /**
   * One Topic has Many Posts.
   * @OneToMany(targetEntity="FM\App\Models\Post", mappedBy="topic_id")
   */
  protected $posts = null;


  public function __construct() {
    $this->category = new ArrayCollection();
    $this->posts = new ArrayCollection();
  }

  public function getCategoryId() {
    return $this->category_id;
  }

  public function addCategory($category) {
    $this->usedCategory[] = $category;
  }

  public function getId() {
    return $this->id;
  }

  public function getName() {
    return $this->name;
  }

  public function getEnabled() {
    return $this->enabled;
  }

  public function getCategory() {
    return $this->category;
  }

  public function getPosts() {
    return $this->posts;
  }

}
