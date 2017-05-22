<?php
//basic form class

namespace Solaria\Framework\View\Forms;

use Solaria\Framework\Url\Url;

class Form {

    private $items = array();
    private $formClass = '';
    private $id = '';
    private $method = '';
    private $url = '';

    public function render() {
        echo '<form class="'.$this->formClass.'" id="'. $this->id .'" method="'.$this->method.'" action="'.URL::getBaseURL().'/'.$this->url.'">';
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

    protected function setId($id) {
      $this->id = $id;
    }

}
