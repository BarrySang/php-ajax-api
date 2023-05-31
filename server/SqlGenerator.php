<?php declare(strict_types=1);

class SqlUpdate {
    // properties
    private $fieldsArray = array(), $whereCondition = array();

    // constructor
    function __construct(array $fieldsArray = array(), array $whereCondition = array()) {
        $this->fieldsArray = $fieldsArray;
        $this->whereCondition = $whereCondition;
    }

    /**
     * methods
     */
    // generate sql
    private function generateSql($fieldsArray, $whereCondition) {

    }
}