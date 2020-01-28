<?php
    /**
     *
     */
    class Crud{
      // database connection and table name
       private $conn;
       private $tableName;

       public function __construct($db){
           $this->conn = $db;
       }

       // create object
        public function create(){}
        // read object
        public function read(){}
        // edit object
        public function edit(){}
        // delete object
        public function delete(){}
    }

 ?>
