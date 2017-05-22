<?php
namespace Solaria\Framework\View\Forms\Fields;

use Solaria\Framework\View\Forms\Fields\FieldInterface;

class SelectField implements FieldInterface {

    protected $name;
    protected $labelName;
    private $dropDowns;

    public function __construct($labelName, $name, $dropDowns = array()) {
        $this->labelName = $labelName;
        $this->name = $name;
        $this->dropDowns = $dropDowns;
    }

    public function render() {
        //htmls stuff here
        echo '<label>'.$this->labelName.'</label>';
        echo '<select name="'. $this->name .'">';
        foreach ($this->dropDowns as $name => $value) {
            echo '<option value="'.$value.'">'.$name.'</option>';
        }
        echo '</select>';

    }

}
