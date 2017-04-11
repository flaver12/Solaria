<?php

namespace FM\App\models;

use FM\Framework\model\BaseModel;

/**
 * @Entity @Table(name="user")
 **/
class User extends BaseModel {

    /** @Id @Column(type="integer") @GeneratedValue **/
    protected $id;

    /** @Column(type="string") **/
    protected $username;

    /** @Column(type="string") **/
    protected $password;

    /**
     * One User has Many Posts.
     * @OneToMany(targetEntity="FM\App\Models\Post", mappedBy="user_id")
     */
    protected $posts = null;

    public function __construct() {
      $this->posts = new ArrayCollection();
    }

    public function setUsername($username) {
      $this->username = $username;
    }

    public function setPassword($password) {
      $this->password = $password;
    }

    public function getPosts() {
      return $this->posts;
    }

    public function getId() {
      return $this->id;
    }


}
