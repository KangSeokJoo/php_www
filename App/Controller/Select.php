<?php
namespace App\Controller;

class Select
{
    private $db;
    private $HttpUri;

    private $Html;
    //생성자
    public function __construct($db)
    {
        // echo __CLASS__;
        $this->db = $db;
        $this ->HttpUri = new \Module\Http\Uri();
        $this ->Html = new \Module\Html\HtmlTable;
    }


    //처음 동작 구분 처리
    public function main()
    {
        $tableName = $this->HttpUri->second();
        if($this->HttpUri->third() == "new"){
            echo " 새로운 데이터 입력";
            $this ->newInsert($tableName);
        }else{
            $this->list($tableName);   
        }
    }

    // 새로운 데이터를 입력
    public function newInsert($tableName)
    {
        print_r($_POST);
        
        if($_POST){
            $query = "INSERT INTO ".$tableName." (`FirstName`,`LastName`) VALUES
             ('".$_POST['firstname']."','".$_POST['lastname']."')";
            $result = $this->db->queryExecute($query);

             //페이지 이동
             header("location:"."/Select/".$tableName);
        }

        $query = "DESC " . $tableName;
        $result = $this->db->queryExecute($query);
        $count = mysqli_num_rows($result);
        $content = ""; // 초기화
        $rows = []; // 배열 초기화
        for ($i=0;$i<$count;$i++) {
            $row = mysqli_fetch_object($result);
            $rows []= $row; // 배열 추가 (2차원)
            
        }
        $content = $this->Html->table($rows);

        $body = file_get_contents("../Resource/Insert.html");
        $body = str_replace("{{content}}",$content, $body); // 데이터 치환
        echo $body;
    }

    public function list($tableName)
    {
        // $uri = $_SERVER['REQUEST_URI'];
        // $uris = explode("/", $uri);
        // []/[select]/[members]
        
        if($tableName)
        { // 내용이 있어야돼고 값이있어야됌
            $query = "SELECT * from " . $tableName; // sql 쿼리문
            $result = $this->db->queryExecute($query); // 쿼리를 읽어주고

            $content = ""; // 초기화
            $rows = []; // 배열 초기화

            $count = mysqli_num_rows($result); // 갯수를 파악
            if($count){
                //0 보다 크다는말임 = true
                for ($i=0;$i<$count;$i++) {
                    $row = mysqli_fetch_object($result); //객체로 받아온다
                    // print_r($row);
                    $rows [] = $row; //배열 추가 (2차원 배열)   
                }
                $content = $this->Html->table($rows);
            }else{
                // 데이터 없음
                $content = "데이터 없음";
            }
        }else{
            $content = "선택된 테이블이 없습니다.";
        }
        
      
        $body = file_get_contents("../Resource/Select.html");
        $body = str_replace("{{content}}",$content, $body); // 데이터 치환
        echo $body;
    }
}