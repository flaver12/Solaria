<?php

namespace Solaria\Framework\View;

use Solaria\Framework\Url\Url;
use Solaria\Framework\Application;
use Solaria\Framework\Acl\Acl;
use Solaria\App\Models\Resource;
use Solaria\App\Models\Post;

//basic view helper fncs!
class ViewHelper {

    public function link_to($name, $value = "", $class="", $id="", $message=''){
        if($message != '') {
            echo '<a href="'.Url::getBaseURL().'/'.$value.'" class="'.$class.'" onclick="return confirm(\''.$message.'\')">'.$name.'</a>';
        } else {
            echo '<a href="'.Url::getBaseURL().'/'.$value.'" class="'.$class.'">'.$name.'</a>';
        }
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
        echo Application::singleton('Solaria\Framework\View\BBCodeParser')->parse($code);
    }

    public function countUserPosts($userId) {
        return count(Post::findBy(array('user_id' => $userId)));
    }

    public function isAllowed($group, $resource) {
        return Application::singleton('acl')->isAllowed($group, $resource);
    }

}
