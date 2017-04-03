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


    //@AS_TODO: fix this shit!
    public function getBreadcrum() {
      $q = "SELECT topic.id as topic_id, topic.name as topic_name, category.name as category_name, category.id as category_id
            FROM topic
            JOIN category ON topic.category_id = category.id";

      $res = self::send(array($q));
      $res = $res->getFirst();

      $res = array(
        0 => array(
          'name'  => $res->category_name,
          'id'    => $res->category_id,
          'link'  => 'forum'
        ),
        1 => array(
          'name'  => $res->topic_name,
          'id'    => $res->topic_id,
          'link'  => '/view-topic/'.$res->topic_id
        )

      );

      return $res;

    }
}
