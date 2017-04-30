<?php
namespace FM\App\Forms;

use FM\Framework\View\Forms\Form;
use FM\Framework\View\Forms\Fields\InputField;
use FM\Framework\View\Forms\Fields\Button;
use FM\Framework\View\Forms\Fields\TextAreaField;

class BBCodeForm extends Form {

    public function __construct($url, $blockTitle=false) {
        $this->setMethod('POST');
        $this->setFormClass('.form-inline .bbcodeColor');
        $this->setId('responseForm');
        $this->setURL($url);
        if(!$blockTitle) {
            $this->addItem(new InputField('Titel', 'title', array('class' => '',  'type' => 'text', 'value' => '',)));
        }
        $this->addItem(new TextAreaField('content', array('id' => "editor")));
        $this->addItem(new InputField('', 'topic_id', array('class' => 'bbcode-form-topic-id',  'type' => 'hidden', 'value' => '',)));
        $this->addItem(new Button('Posten'));
    }
}
