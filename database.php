<?php

require_once('new_config.php');


class Database {

    private $connection;

function __construct() {

    $this->open_db_connection();
}

    public function getConnection () {
    return $this->connection;
    }


    public function open_db_connection() {

         $this->connection = mysqli_connect(DB_HOST,DB_USER,DB_PASSWORD,DB_NAME);

        if(mysqli_connect_error()) {
            die("database failed" . mysqli_error());
        }
    }

    public function query($sql) {
        
        $result = mysqli_query($this->connection, $sql);
        if(!$result) {
            die('Query failed.');
        }
        return $result;

    }
}

// Initializera direct.
$database = new Database();

?>