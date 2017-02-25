<?php

class SingUpForm extends Form {

    public function __construct() {
        $this->setMethod('POST');
        $this->setFormClass('form-inline');
        $this->setURL('sing-up');
        $this->addItem(new InputField('username', 'username', array('class' => "form-control", 'type' => 'text')));
        $this->addItem(new InputField('password', 'password', array('class' => "form-control", 'type' => 'password')));
        $this->addItem(new Button('Sing In!'));
    }
}
