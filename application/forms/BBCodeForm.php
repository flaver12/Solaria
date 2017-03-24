<?php

class BBCodeForm extends Form {

    public function __construct() {
        $this->setMethod('POST');
        $this->setFormClass('form-inline');
        $this->setURL('forum/create-post');
        $this->addItem(new TextAreaField('content', array('id' => "editor")));
        $this->addItem(new Button('Sing In!'));
    }
}
