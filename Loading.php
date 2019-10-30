<?php
// sql_autoload_register 자동으로 require 해주는 기능
// 이 기능을 등록해준다 익명함수로 전달
spl_autoload_register(function($classname){
    // echo $classname;
    //클래스 이름을 조합해서, require 해준다.
    require "../".$classname.".php";
    // exit;
});