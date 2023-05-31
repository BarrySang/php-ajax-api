<?php declare(strict_types=1);

// imports
include 'FileReader.php';

class DbCredentials {
    // properties
    private $servername, $username, $password, $dbName;

    /*
    * methods
    */

    // constructor
    function __construct() {

        // create fileReader object to read .env file
        $fileReader = new FileReader(".env", array("SERVERNAME", "USERNAME", "PASSWORD", "DBNAME"));

        // run method to get values from .env file
        $data = $fileReader->wordSearch();

        /**
         * assign values
         */
        $this->servername = $data['SERVERNAME'];
        $this->username = $data['USERNAME'];
        $this->password = $data['PASSWORD'];
        $this->dbName = $data['DBNAME'];
    }

    // return properties
    public function getServername() {
        return $this->servername;
    }

    public function getUsername() {
        return $this->username;
    }

    public function getPassword() {
        return $this->password;
    }

    public function getDbName() {
        return $this->dbName;
    }
}