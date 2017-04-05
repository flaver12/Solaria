<?php

namespace FM\Framework\view;

use FM\Framework\url\Url;

//basic view helper fncs!
class ViewHelper {

    public function link_to($name, $value = "", $class="", $id=""){
        echo '<a href="'.URL::getBaseURL().'/'.$value.'" class="'.$class.'">'.$name.'</a>';
    }

    public function start_link($value = "", $class="", $id="") {
        echo '<a href="'.URL::getBaseURL().'/'.$value.'" class="'.$class.'">';
    }

    public function end_link() {
        echo "</a>";
    }

    public function include_css($path) {
        echo '<link href="'.URL::getBaseURL().'/'.$path.'" rel="stylesheet" />';
    }
    public function include_script($path) {
        echo '<script src="'.URL::getBaseURL().'/'.$path.'"></script>';
    }

    public function parserBBCode($code) {
        echo Application::singleton('BBCodeParser')->parse($code);
    }

}
