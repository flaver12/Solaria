<?php

class Post extends BaseModel {

    public $id;
    public $topic_id;
    public $user_id;
    public $title;
    public $content;
    public $created;
    public $enabled;


    public function getBreadcrum() {
      $q = "SELECT post.id as post_id, post.title as post_title, topic.id as topic_id, topic.name as topic_name, category.name as category_name
            FROM post
            JOIN topic ON post.topic_id = topic.id
            JOIN category ON topic.category_id = category.id";

      $res = self::send(array($q));
      $res = $res->getFirst();

      $res = array(
        0 => array(
          'name'  => $res->category_name,
          //'id'    => $res->category_id,
          'link'  => 'forum'
        ),
        1 => array(
          'name'  => $res->topic_name,
          'id'    => $res->topic_id,
          'link'  => 'forum/view-topic/'.$res->topic_id
        ),
        2 => array(
          'name'  => $res->post_title,
          'id'    => $res->post_id,
          'link'  => 'forum/view-post/'.$res->post_id
        )

      );

      return $res;
    }
}
