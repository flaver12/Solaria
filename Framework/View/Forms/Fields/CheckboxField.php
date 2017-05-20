<?php
namespace Solaria\Framework\View\Forms\Fields;

use Solaria\Framework\View\Forms\Fields\FieldInterface;

class CheckboxField implements FieldInterface {

    protected $name;
    protected $labelName;
    private $checkBoxes;

    public function __construct($labelName, $name, $checkBoxes = array()) {
        $this->labelName = $labelName;
        $this->name = $name;
        $this->checkBoxes = $checkBoxes;
    }

    public function render() {
        //htmls stuff here
        echo '<label>'.$this->labelName.'</label>';
        echo " <br />";
        foreach ($this->checkBoxes as $name => $value) {
            echo '<input type="checkbox" name="'. $name .'" value="'.$value.'">'.$name.'<br />';
        }

    }

}
