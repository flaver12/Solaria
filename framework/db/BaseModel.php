<?php

abstract class BaseModel {

    protected function saveObj($obj) {
        Application::set(strtolower(get_called_class()), $obj);
    }

    public static function send($q) {
        if(!isset($q)) {
            throw new Exception("Empty query given!!");
        }
        $db = Application::singleton('DbCore');
        $result = $db->sendQuery($q, get_called_class());

        return $result;
    }

    public static function getAll() {
        return self::send(array(
            'SELECT * FROM ' . strtolower(Application::getCaller())
        ));
    }

    public static function get($condition = '') {
        if($condition == '') {
            throw new Exception("No condition given!");
        }

        $db = Application::singleton('DbCore');
        $class = get_called_class();
        if(strpos($class, 'Controller') !== false) {
            $class = Application::getCaller();
        }
        return $db->sendQuery(array('SELECT * FROM '.strtolower($class).' WHERE '.$condition), strtolower($class));

    }

    //nerver call this function from a controller!!! NEVER!!!! AND DONT TOUCH IT NOOOO!!!
    //@AS_TODO phalcon like, if we have a obj, just UPDATE
    protected function save($obj) {
        $db = Application::singleton('DbCore');
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
