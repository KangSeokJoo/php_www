<?php
//밑줄 구분 스네이크 케이스 주로 함수
//뒷문장 대문자 카멜 케이스 주로 메소드
//맨앞에 대문자는 주로 클래스

// 선언 -> 생성 -> 호출
// 데이터베이스 선언
class Database
{
// 매직메소드 알아서 생성자를 만드는 __construct
    public $connect; // 프로퍼티 (콘넥트엔 객체가 들어가있음 메소드 내)
    //복합객체

    // public , private , protected 전체 , 내부, 상속만
    
    private $Table;
// 객체지향의 (은닉화)
    public function setTable($name)
    {
        $this->Table = $name;
        return $this;
    }

    public function getTable()
    {
        return $this->Table;
    }

    public function __construct($config)
    { //생성자 메소드(함수)

        //자기 파일에 테이블에다가 클래스 테이블에 그 자신을 가리킨다??
        $this->Table = new Table($this); //이걸 쓰면 setTable을 안쓰고 get으로 넘어감

        echo "클래스 생성 <br>";
        $this->connect = new mysqli($config['host'], $config['user'], $config['passwd'], $config['database']);
        
        //성공 : connect_errno = 0
        //실패 : connect_errno = 1

        if(!$this->connect->connect_errno){
            echo "DB 접속 성공이에요<br>";
        }else{
            echo "접속이 안돼요 ㅜ"."<br>";
        }
        // 이미 지역변수로 사용가능하기떄문에 $host 앞에 this를 안붙여도됌
    }
    public function queryExecute($query)
    {
        $result = mysqli_query($this->connect, $query);
        if($result){
            echo "쿼리 성공". "<br>";
        }else{
            print "쿼리 실패". "<br>";
        }

        return $result;
    }

    //table 확인
    public function isTable($tablename)
    {
        $query = "SHOW TABLES";
        $result = $this->queryExecute($query); //db에서 생성한 Database에서 queryExecute를 호출

        $count = mysqli_num_rows($result); //테이블 갯수나오는 함수
        echo "테이블 갯수는 = ".$count;
        echo "</br>";

        for($i=0; $i<$count; $i++){
            $row = mysqli_fetch_object($result);  // 
            
            if($row->Tables_in_php == $tablename){
            return true;
            }
            echo "테이블=".$row->Tables_in_php."</br>"; //mysql에서 테이블을 갖구옴 ?? 객체를 갖구오는건가
            // print_r($row);
        }
        return false;
    }
    
}