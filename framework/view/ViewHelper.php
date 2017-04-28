<?php

namespace FM\Framework\view;

use FM\Framework\Url\Url;
use FM\Framework\Application;
use FM\Framework\Acl\Acl;
use FM\App\Models\Resource;

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
        echo '<link href="'.URL::getUrlPath().'/'.$path.'" rel="stylesheet" />';
    }
    public function include_script($path) {
        echo '<script src="'.URL::getUrlPath().'/'.$path.'"></script>';
    }

    public function include_img($path) {
        echo '<img src="'.URL::getUrlPath().'/'.$path.'" class="img-responsive center-block" />';
    }

    public function parserBBCode($code) {
        echo Application::singleton('FM\Framework\View\BBCodeParser')->parse($code);
    }

    public function checkPermission($name, $id, $user){
        $acl = new Acl($user);
        $result = Resource::findBy(array('name' => $name.'.'.$id));
        if(empty($result)) {
            return true;
        } else {
            if($acl->hasPermission($result)) {
                return true;
            } else {
                return false;
            }
        }
    }

    public function isAdmin($user) {
        $acl = new Acl($user);
        return $acl-isAdmin();
    }

}
