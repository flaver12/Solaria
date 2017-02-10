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
 */

namespace devStorm\Models;
use devStorm\Models\BaseModel;

class Post extends BaseModel {

    public $id;

    public $user_id;

    public $category_id;

    public $thread_id;

    public $replay;

    public $title;

    public $body;

    public $created;

    public $modified;

    public $deleted;

    public $hidden;

    public $visible;

    public function getSource() {
        return "Post";
    }
    public function initialize() {
        $this->belongsTo("user_id", "devStorm\Models\User", "id", array('alias' => 'user'));
    }
}
