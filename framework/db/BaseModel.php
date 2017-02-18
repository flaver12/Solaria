<?php

class BaseModel {

    protected $tableName = '';

    protected function run() {
        $db = Application::singelton('DbCore');
        $rows = $db->sendQuery('','post')->getRows();

        foreach ($rows as $row) {
            $row->update('title', 'test!');
        }
    }

    public function get() {

    }

}
