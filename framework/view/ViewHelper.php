<?php

//basic view helper fncs!
class ViewHelper {

    public function link_to($name, $value = "", $class="", $id=""){
        echo '<a href="'.URL::getBaseURL().'/'.$value.'" class="'.$class.'">'.$name.'</a>';
    }

}
