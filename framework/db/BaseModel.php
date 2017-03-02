<?php

abstract class BaseModel {

    protected function saveObj($obj) {
        Application::set(strtolower(get_called_class()), $obj);
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

    //nerver call this function from a controller!!! NEVER!!!! AND DONT TOUCH IT NOOOO!!!
    //@AS_TODO phalcon like, if we have a obj, just UPDATE
    protected function save($obj) {
        $db = Application::singelton('DbCore');
        $q = 'INSERT INTO '.strtolower(get_called_class()).' (';
        $values = array();

        //colum names
        foreach ($obj as $name => $value) {
            if(isset($value) && $value != '') {
                $q = $q.$name.',';
                $values[':'.$name] = $value;
            }
        }
        $q = rtrim($q,",");
        $q = $q.') VALUES (';

        //value names
        foreach ($obj as $name => $value) {
            if(isset($value) && $value != '') {
                $q = $q.':'.$name.',';
            }
        }

        $q = rtrim($q,",");
        $q = $q.')';

        return $db->sendQuery(array($q, $values), strtolower(get_called_class()));
    }



}
