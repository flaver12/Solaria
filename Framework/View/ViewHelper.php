<?php

namespace FM\Framework\View;

use FM\Framework\Url\Url;
use FM\Framework\Application;
use FM\Framework\Acl\Acl;
use FM\App\Models\Resource;
use FM\App\Models\Post;

//basic view helper fncs!
class ViewHelper {

    public function link_to($name, $value = "", $class="", $id=""){
        echo '<a href="'.Url::getBaseURL().'/'.$value.'" class="'.$class.'">'.$name.'</a>';
    }

    public function start_link($value = "", $class="", $id="") {
        echo '<a href="'.Url::getBaseURL().'/'.$value.'" class="'.$class.'">';
    }

    public function end_link() {
        echo "</a>";
    }

    public function include_css($path) {
        echo '<link href="'.Url::getUrlPath().'/'.$path.'" rel="stylesheet" />';
    }
    public function include_script($path) {
        echo '<script src="'.Url::getUrlPath().'/'.$path.'"></script>';
    }

    public function include_img($path) {
        echo '<img src="'.Url::getUrlPath().'/'.$path.'" class="img-responsive center-block" />';
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

    public function countUserPosts($userId) {
        return count(Post::findBy(array('user_id' => $userId)));
    }

}
