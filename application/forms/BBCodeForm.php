<?php
namespace FM\App\forms;

use FM\Framework\view\Forms\Form;
use FM\Framework\view\Forms\fields\InputField;
use FM\Framework\view\Forms\fields\Button;
use FM\Framework\view\Forms\fields\TextAreaField;

class BBCodeForm extends Form {

    public function __construct($url) {
        $this->setMethod('POST');
        $this->setFormClass('.form-inline .bbcodeColor');
        $this->setId('responseForm');
        $this->setURL($url);
        $this->addItem(new TextAreaField('content', array('id' => "editor")));
        $this->addItem(new InputField('', 'topic_id', array('class' => 'bbcode-form-topic-id',  'type' => 'hidden', 'value' => '',)));
        $this->addItem(new Button('Sing In!'));
    }
}
