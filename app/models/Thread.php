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
| @desc thread model                                                     |
+------------------------------------------------------------------------+
 */

namespace devStorm\Models;
use devStorm\Models\BaseModel;

class Thread extends BaseModel {

    public $id;

    public $name;

    public $onlyAdmin;


    public function getSource() {
        return "Thread";
    }

}
