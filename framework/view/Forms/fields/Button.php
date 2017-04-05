<?php
namespace FM\Framework\view\Forms\fields;

use FM\Framework\view\Forms\fields\FieldInterface;

class Button implements FieldInterface {

    protected $name;
    private $type;

    public function __construct($name, $type = 'submit') {
        $this->name = $name;
        $this->type = $type;
    }

    public function render() {
        //htmls stuff here
        echo '<button type="'.$this->type.'" class="btn btn-default">'.$this->name.'</button>';

    }

}
