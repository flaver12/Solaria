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
| @desc user model                                                       |
+------------------------------------------------------------------------+
 */

namespace devStorm\Models;
use devStorm\Models\BaseModel;
use devStorm\Library\Mail\Mail;

class User extends BaseModel {

	public $id;

	public $username;

	public $email;

	public $created;

	public $last_time_online;

	public $validated;

	public $group_id;

	public $banned;

    public $online;

	public function getSource() {
        return "User";
    }

    public function initialize() {
        $this->hasMany("id", "devStorm\Models\Post", "user_id", array('alias' => 'posts'));
	    $this->belongsTo("group_id", "devStorm\Models\Group", "id", array('alias' => 'groups'));
    }

	public static function haveUser($username) {
		$user = User::findByUsername($username);
		if($user !== false) {
			return true;
		} else {
			return false;
		}
	}

	public function afterCreate() {
        $mail = new Mail();
        $mail->setTemplate('confirm');
        $mail->send($this->email, 'Registrierung abschliessen', array('username' => $this->username, 'emailUrl' => 'http://dev-storm.com/confirm/'.md5($this->email).'/'.$this->email));
	}
}
?>
