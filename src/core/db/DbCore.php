<?php
//Simple db adapter not nice but works!

class DbCore {

    protected $db;

    public function __construct($host, $user, $pw, $dbname) {
        $options = array(
            PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8',
        );
        $dsn        = 'mysql:host='.$host.';dbname='.$dbname;

        try {
            $this->db   = new PDO($dsn, $user, $pw, $options);
        } catch (Exception $e) {
            //ignore!!
        }
    }

}
