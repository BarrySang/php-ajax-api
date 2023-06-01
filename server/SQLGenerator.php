<?php declare(strict_types=1);

class SQLGenerator {
    // properties
    private $operation, $tablename, $fields_values = array(), $filtersArray = array();

    // constructor
    function __construct($operation, $tablename, array $fields_values, array $filtersArray = array()) {
        $this->operation = $operation;
        $this->tablename = $tablename;
        $this->fields_values = $fields_values;
        $this->filtersArray = $filtersArray;
    }

    /**
     * methods
     */
    // generate sql
    public function generateSql() {
        switch(strtoupper($this->operation)) {
            case "INSERT":
                $character = ":";
                return strtoupper($this->operation)." INTO ".$this->tablename." (".implode(", ", array_keys($this->fields_values)).") VALUES (".implode(", ", array_map(function($originalValue) use ($character) {
                    return $character.$originalValue;
                }, array_keys($this->fields_values))).")";
        }
    }

    private function addChar($originalValue) {
        return ":".$originalValue;
    }
}