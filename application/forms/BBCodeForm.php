<?php
namespace FM\App\forms;

use FM\Framework\View\Forms\Form;
use FM\Framework\View\Forms\Fields\InputField;
use FM\Framework\View\Forms\Fields\Button;
use FM\Framework\View\Forms\Fields\TextAreaField;

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
