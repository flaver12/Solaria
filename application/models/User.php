<?php

class User extends BaseModel {

    public function __destruct() {
        $this->run();
    }
}
