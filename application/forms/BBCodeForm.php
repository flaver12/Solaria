<?php
namespace FM\App\forms;

use FM\Framework\view\Forms\Form;
use FM\Framework\view\Forms\fields\InputField;
use FM\Framework\view\Forms\fields\Button;
use FM\Framework\view\Forms\fields\TextAreaField;

class BBCodeForm extends Form {

    public function __construct() {
        $this->setMethod('POST');
        $this->setFormClass('form-inline');
        $this->setURL('forum/create-post');
        $this->addItem(new TextAreaField('content', array('id' => "editor")));
        $this->addItem(new Button('Sing In!'));
    }
}
