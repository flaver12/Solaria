<?php

class User extends BaseModel {

    public $id;
    public $username;
    public $password;

    public function __destruct() {
        $this->saveObj($this);
    }

    /*public function save() {
        parent::save();
    }*/
}
