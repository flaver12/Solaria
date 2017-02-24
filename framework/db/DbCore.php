<?php
//Simple db adapter not nice but works!

class DbCore {

    protected static $db;

    public function __construct($host, $user, $pw, $dbname) {
        $options = array(
            PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8',
        );
        $dsn        = 'mysql:host='.$host.';dbname='.$dbname;

        try {
            self::$db = new PDO($dsn, $user, $pw, $options);
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }

    public function sendQuery($query = array(), $table='', $single = false) {

        if(!isset($query))
            throw new Exception("empty query given!");

        $stmt = self::$db->prepare($query[0]);

        if(isset($query[1])) {
            $stmt->execute($query[1]);
        } else {
            $stmt->execute();
        }


        if($single) {
            $result = $stmt->fetchObject('Row');
            $result->setTable($table);
            return $result;
        } else {
            $result = $stmt->fetchAll(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, 'Row');
            return Application::newInstance('Resultset', array($result, $table));
        }
    }

    public function __destruct() {
    }

}
