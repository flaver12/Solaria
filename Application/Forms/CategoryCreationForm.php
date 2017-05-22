<?php
namespace Solaria\App\Forms;

use Solaria\Framework\View\Forms\Form;
use Solaria\Framework\View\Forms\Fields\InputField;
use Solaria\Framework\View\Forms\Fields\Button;
use Solaria\Framework\View\Forms\Fields\TextAreaField;

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
