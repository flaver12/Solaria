<?php

//basic view helper fncs!
class ViewHelper {

    public function link($name, $value = "", $class="", $id=""){
        echo '<a href="'.URL::getBaseURL().'/'.$value.'" class="'.$class.'">'.$name.'</a>';
    }

}
