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

    public function setUsername($username) {
      $this->username = $username;
    }

    public function setPassword($password) {
      $this->password = $password;
    }


}
