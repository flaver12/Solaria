<?php

class User extends BaseModel {
    
    public function __construct() {
        $this->tableName = 'user';
    }

    public function __destruct() {
        $this->run();
    }
}
