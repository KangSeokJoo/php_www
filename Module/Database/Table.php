<?php

//선언
class Table
{
    public $table_name;

    public $Database;


    public function __construct($database){
        echo "테이블 클래스 생성<br>";
        $this->Database = $database;
    }

    public function createTable($name, array $fileds){

        echo "테이블을 생성합니다 <br>";
       
        $query = "
        CREATE TABLE `".$name."` (
        `id` int(11) NOT NULL AUTO_INCREMENT,

        ";
        // `LastName` varchar(255),
        // `FirstName` varchar(255),

        foreach($fileds as $key => $value){
            $query .= " `$key` $value,";
        }

        $query .= "
        PRIMARY KEY(`id`)
        ) ENGINE=innodb default charset=utf8;
        ";

        mysqli_query($this->Database->connect, $query);
    }
}