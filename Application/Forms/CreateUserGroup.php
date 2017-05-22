<?php
namespace Solaria\App\Forms;

use Solaria\Framework\View\Forms\Form;
use Solaria\Framework\View\Forms\Fields\InputField;
use Solaria\Framework\View\Forms\Fields\Button;
use Solaria\Framework\View\Forms\Fields\SelectField;
use Solaria\Framework\View\Forms\Fields\CheckboxField;

class CreateUserGroup extends Form {

    public function __construct($permissions) {
        $this->setMethod('POST');
        $this->setFormClass('.form-inline ');
        $this->setURL('admin/create-group');
        $this->addItem(new InputField('Name', 'name', array('class' => 'bbcode-form-topic-id',  'type' => 'text', 'value' => '',)));
        $this->addItem(new CheckboxField('Berechtigungen(Read sollte immer gesetzt werden!)', 'allow_see', $permissions));
        $this->addItem(new Button('Erstellen'));
    }
}
