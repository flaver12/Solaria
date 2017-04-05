<?php
//basic form class

namespace FM\Framework\view\Forms;

use FM\Framework\url\Url;

class Form {

    private $items = array();
    private $formClass = '';
    private $method = '';
    private $url = '';

    public function render() {
        echo '<form class="'.$this->formClass.'" method="'.$this->method.'" action="'.URL::getBaseURL().'/'.$this->url.'">';
        foreach ($this->items as $item) {
            echo '<div class="form-group">';
                $item->render();
            echo '</div>';
        }
        echo "</form>";
    }

    protected function addItem($item) {
        array_push($this->items, $item);
    }

    protected function setFormClass($formClass) {
        $this->formClass = $formClass;
    }

    protected function setMethod($method = 'GET') {
        $this->method = $method;
    }

    protected function setURL($url) {
        $this->url = $url;
    }

}
