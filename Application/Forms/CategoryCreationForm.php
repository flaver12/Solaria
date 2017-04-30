<?php
namespace FM\App\Forms;

use FM\Framework\View\Forms\Form;
use FM\Framework\View\Forms\Fields\InputField;
use FM\Framework\View\Forms\Fields\Button;
use FM\Framework\View\Forms\Fields\TextAreaField;

class CategoryCreationForm extends Form {

    public function __construct() {
        $this->setMethod('POST');
        $this->setFormClass('.form-inline ');
        $this->setId('responseForm');
        $this->setURL('admin/create-category');
        $this->addItem(new InputField('Name', 'name', array('class' => 'bbcode-form-topic-id',  'type' => 'text', 'value' => '',)));
        $this->addItem(new Button('Erstellen'));
    }
}
