<?php

//single record
class Row {

    public $table;

    public function update($name, $value) {
        //@AS_TODO: do it with escape 
        $q = 'UPDATE '.$this->table.' SET '.$name.' = "'.$value.'" WHERE id= '.$this->id;
    }

    public function setTable($table) {
        $this->table = $table;
    }

}
