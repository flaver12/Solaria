<?php
/**
+------------------------------------------------------------------------+
| dev-storm.com                                                          |
+------------------------------------------------------------------------+
| Copyright (c) 2014 dev-storm.com Team                                  |
+------------------------------------------------------------------------+
| @author flaver <flaver@dev-storm.com>                                  |
| @copyright flaver, dev-storm.com                                       |
| @package devstorm.forms                                                |
| @desc register from                                                    |
+------------------------------------------------------------------------+
 */

namespace devStorm\Forms;

use Phalcon\Forms\Form,
    Phalcon\Validation\Validator\PresenceOf,
    Phalcon\Validation\Validator\StringLength,
    Phalcon\Validation\Validator\Confirmation,
    Phalcon\Validation\Validator\Email,
    Phalcon\Forms\Element\Text,
    Phalcon\Forms\Element\Password,
    Phalcon\Forms\Element\Submit;

class RegisterForm extends Form {
    public function initialize($entity = null, $options = null) {
        $username = new Text("username");
        $username->addValidators(array(new PresenceOf(
        	array(
        		'message' => 'Bitte geben Sie einen Usernamen ein'
        	)
        )));
        $username->addValidators(array(new StringLength(
        	array(
        		'min' => 5,
        		'message' => 'Der Username muss mindestens 5 Zeichen lang sein'
        	)
        )));
        $password1 = new Password("password1");
        $password1->addValidators(array(new PresenceOf(
        	array(
        		'message' => 'Bitte geben Sie einen Passwort ein'
        	)
        )));
        $password1->addValidators(array(new StringLength(
	    	array(
	    		'min' => 8,
	    		'message' => 'Das Passwort muss mindestens 8 Zeichen lang sein'
	    	)
    	)));
    	$password2 = new Password("password2");
        $password2->addValidators(array(new PresenceOf(
        	array(
        		'message' => 'Bitte geben Sie einen Passwort ein'
        	)
        )));
        $password2->addValidators(array(new StringLength(
	    	array(
	    		'min' => 8,
	    		'message' => 'Das Passwort muss mindestens 8 Zeichen lang sein'
	    	)
    	)));
    	 $password2->addValidators(array(new Confirmation(
	    	array(
	    		'with' => 'password1',
	    		'message' => 'Das Passwort stimmt nicht &uuml;berein'
	    	)
    	)));
    	$email = new Text("email");
    	$email->addValidators(array(new PresenceOf(
        	array(
        		'message' => 'Bitte geben Sie eine Email an'
        	)
        )));
        $email->addValidators(array(new Email(
        	array(
        		'message' => 'Keine g&uuml;ltige Email'
        	)
        )));
        $this->add(new Submit('Sign Up', array(
            'class' => 'btn btn-success'
        )));
    	$this->add($username);
    	$this->add($password1);
    	$this->add($password2);
    	$this->add($email);
    }

    public function messages($name)
    {
        if ($this->hasMessagesFor($name)) {
            foreach ($this->getMessagesFor($name) as $message) {
                $this->flash->error($message);
            }
        }
    }
}
?>