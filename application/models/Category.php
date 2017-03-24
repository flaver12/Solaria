<?php

class Category extends BaseModel {

    public $id;
    public $name;
    public $created;
    public $enabled;

    public function getAllWithTopics() {
        $result = array();
        $cats = self::getAll()->getRows();
        $i = 0;
        foreach($cats as $cat) {
            $topics = Topic::get('category_id = '.$cat->id)->getRows();
            $result[$i] = array(
                'name' => $cat->name,
                'topics' => $topics
            );

            $i ++;
        }

        return $result;
    }

}
