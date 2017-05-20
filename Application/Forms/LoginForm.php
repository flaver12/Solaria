<?php

namespace Solaria\App\Forms;

use Solaria\Framework\View\Forms\Form;
use Solaria\Framework\View\Forms\Fields\InputField;
use Solaria\Framework\View\Forms\Fields\Button;

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
