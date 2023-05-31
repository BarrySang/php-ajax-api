<?php declare(strict_types=1);

/**
 * imports
 */
/* -- imports go here -- */
include 'DbCredentials.php';

class Request {
    // properties
    private $servername, $username, $password, $dbname, $sql, $conn, $stmt, $reqValues = array(), $method, $result;

    /**
     * methods
     */
    // constructor
    function __construct($sql, $method, array $reqValues = array()) {

        // create object to get database credentials
        $dbCredentials = new DbCredentials();

        /**
         * assign values
         */
        $this->servername = $dbCredentials->getServername();
        $this->username = $dbCredentials->getUsername();
        $this->password = $dbCredentials->getPassword();
        $this->dbname = $dbCredentials->getDbName();
        $this->sql = $sql;
        $this->method = $method;
        $this->reqValues = $reqValues;
    }

    // public function setReqValues(array $reqValues) {
    //     $this->reqValues = $reqValues;
    // }

    // function to setablish connection and execute instructions
    public function establishConn() {        
        try {
            // connect to database
            $this->conn = new PDO("mysql:host=$this->servername;dbname=$this->dbname", $this->username, $this->password);

            // set PDO error mode to exception
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            // prepared statement
            $this->stmt = $this->conn->prepare($this->sql);

            // method to return data
            if($this->method == "get") {
                $this->stmt->execute([1]);

                // change result type to be associative array
                $result = $this->stmt->setFetchMode(PDO::FETCH_ASSOC);
                
                // return results
                return $this->stmt;
            }

            // run query and return result
            return $this->stmt->execute($this->reqValues);
        } catch(PDOException $e) {
            // return error if found
            return $this->sql.$e->getMessage();
        }
    }
}