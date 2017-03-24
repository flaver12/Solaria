<?php

class Topic extends BaseModel {

    public $id;
    public $category_id;
    public $name;
    public $created;
    public $enabled;

    public function getWithPosts($id) {
        $result = array();
        $cats = self::get('id = '.$id)->getRows();
        $i = 0;

        foreach($cats as $cat) {
            $posts = Post::get('topic_id = '.$cat->id)->getRows();
            $result[$i] = array(
                'name' => $cat->name,
                'posts' => $posts
            );

            $i++;
        }

        return $result;
    }
}
