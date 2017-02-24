<?php

class BaseModel {

    protected function run() {
        $db = Application::singelton('DbCore');
        $rows = $db->sendQuery('',strtolower(get_called_class()))->getRows();
    }

    public static function send($q) {
        if(!isset($q)) {
            throw new Exception("Empty query given!!");
        }
        $db = Application::singelton('DbCore');
        $result = $db->sendQuery($q, get_called_class());

        return $result;
    }

    public static function getAll() {
        return self::send(array(
            'SELECT * FROM ' . strtolower(get_called_class())
        ));
    }

    public static function get($condition = '') {
        if($condition == '') {
            throw new Exception("No condition given!");
        }

        $db = Application::singelton('DbCore');
        return $db->sendQuery(array('SELECT * FROM '.strtolower(get_called_class()).' WHERE '.$condition), strtolower(get_called_class()), true);

    }

}
