<?php

namespace Solaria\App\Forms;

use Solaria\Framework\View\Forms\Form;
use Solaria\Framework\View\Forms\Fields\InputField;
use Solaria\Framework\View\Forms\Fields\Button;
use Solaria\Framework\View\Forms\Fields\TextAreaField;

class CreatePageForm extends Form {

    public function __construct() {
        $this->setMethod('POST');
        $this->setFormClass('form-inline');
        $this->setURL('admin/create-pages');
        $this->addItem(new InputField('Title', 'title', array('class' => "form-control", 'type' => 'text')));
        $this->addItem(new TextAreaField('content', array('id' => "editor")));
        $this->addItem(new Button('Sing In!'));
    }
}
