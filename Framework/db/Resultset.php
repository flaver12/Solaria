<?php

//contains rowns
class Resultset {

    private $rows = array();

    public function __construct($rows, $table) {

        foreach ($rows as $row) {
            $row->setTable($table);
            array_push($this->rows, $row);
        }

    }

    public function getRows() {
        return $this->rows;
    }

    public function getFirst() {
        return $this->rows[0];
    }

}
