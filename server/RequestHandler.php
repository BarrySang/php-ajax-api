<?php declare(strict_types=1);

/**
 * imports
 */
/* -- imports go here -- */
include 'DbCredentials.php';

class RequestHandler {
    /**
     * properties
     */
    private $servername, $username, $password, $dbname, $sql, $conn, $stmt, $result, $queryCategories = array(), $queryCategoriesLib = array("SELECT", "INSERT INTO", "UPDATE", "DELETE FROM"), $fields_values = array();

    /**
     * methods
     */
    // constructor
    function __construct($sql="", array $field_values) {
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
        $this->fields_values = $field_values;
    }

    // function to execute the sql query and return the result
    public function executeQuery() {
        // establish connection to the database
        $this->establishConn();
        
        // prepare the sql query
        $this->stmt = $this->conn->prepare($this->sql);
        
        // bind parameters to the prepared sql query
        $this->bindParameters($this->fields_values, $this->stmt);
        

        // execute sql query
        $this->result = $this->stmt->execute();
        
        // return data depending on the type of sql query
        // select
        if($this->queryCategory($this->sql, $this->queryCategoriesLib) == "SELECT") {
            $result = $this->stmt->fetch(PDO::FETCH_ASSOC);
            
            if($result) {
                return $result;
            } else {
                echo "no results found";
            }
        
        // insert
        } else if($this->queryCategory($this->sql, $this->queryCategoriesLib) == "INSERT INTO") {
            return $this->stmt->rowCount();

        // update and delete
        } else if($this->queryCategory($this->sql, $this->queryCategoriesLib) == "UPDATE" || "DELETE") {
            if ($this->stmt->rowCount() > 0) {
                echo "update sucessful";
            } else {
                echo "update failed";
            }
        }
    }

    // function to establish database connection, execute the sql quesry and return the result
    private function establishConn() {
        // connect to database
        $this->conn = new PDO("mysql:host=$this->servername;dbname=$this->dbname", $this->username, $this->password);

        // set PDO error mode to exception
        $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }

    // function to categorize the sql statements
    private function queryCategory($sql, $queryCategories) {
        for($i = 0; $i < count($this->queryCategoriesLib); $i++) {
            if(strpos($this->sql, $this->queryCategoriesLib[$i]) === 0) {
                return $this->queryCategoriesLib[$i];
            }
        }
    }

    // function to bind parameters to the prepared statement
    private function bindParameters(array $field_values, $preparedStatement) {
        $values = array();
        foreach($field_values as $field => $value) {
            array_push($values, $value);
        }

        foreach($field_values as $field => $value) {
            $preparedStatement->bindParam(":".$field, $values[array_search("".$field, array_keys($field_values))]);
        }
    }

}