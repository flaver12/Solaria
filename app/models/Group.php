<?php
/**
+------------------------------------------------------------------------+
| dev-storm.com                                                          |
+------------------------------------------------------------------------+
| Copyright (c) 2014 dev-storm.com Team                                  |
+------------------------------------------------------------------------+
| @author flaver <flaver@dev-storm.com>                                  |
| @copyright flaver, dev-storm.com                                       |
| @package devstorm.models                                               |
| @desc post model                                                       |
+------------------------------------------------------------------------+
**/
namespace devStorm\Models;
use devStorm\Models\BaseModel;


class Group extends BaseModel {

    public $id;
    public $name;

    public function getSource() {
        return "Group";
    }

    public function initialize() {
        $this->hasMany("id", "devStorm\Models\User", "group_id", array('alias' => 'users'));
    }

}
