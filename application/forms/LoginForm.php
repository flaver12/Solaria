<?php

namespace FM\App\Forms;

use FM\Framework\View\Forms\Form;
use FM\Framework\View\Forms\Fields\InputField;
use FM\Framework\View\Forms\Fields\Button;

class LoginForm extends Form {

    public function __construct() {
        $this->setMethod('POST');
        $this->setFormClass('form-inline');
        $this->setURL('sing-in');
        $this->addItem(new InputField('username', 'username', array('class' => "form-control", 'type' => 'text')));
        $this->addItem(new InputField('password', 'password', array('class' => "form-control", 'type' => 'password')));
        $this->addItem(new Button('Sing In!'));
    }
}
