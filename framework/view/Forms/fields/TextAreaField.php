<?php
namespace FM\Framework\View\Forms\Fields;

use FM\Framework\View\Forms\Fields\FieldInterface;

class TextAreaField implements FieldInterface {

    private $params;
    private $name;

    public function __construct($name, $params = array()) {
        $this->name = $name;
        $this->params = $params;
    }

    public function render() {
        //htmls stuff here
        echo '<textarea id="'.$this->params['id'].'" name="'.$this->name.'"></textarea>';

    }

}
