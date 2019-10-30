<?php

$config = include "../dbconf.php";

require "../Loading.php";
/*
require "../Module/Database/database.php"; // 1개
require "../Module/Database/table.php"; // 2개
*/

$uri = $_SERVER['REQUEST_URI'];
$uris = explode("/", $uri); //uri의 문자열을 '/' 기준으로 짤라낼꺼다 .
print_r($uris);

$db = new \Module\Database\Database($config);

if(isset($uris[1]) && $uris[1]){ // 배열이 있냐 확인, 배열값이 있냐없냐 확인
    echo $uris[1]."컨트롤러 실행 ...";
    $controllerName = "\App\Controller\\" . ucfirst($uris[1]);
    echo $controllerName;
    $tables = new $controllerName ($db);
    $tables->main();
}else{
    // echo "처음 페이지 에요";
    $body = file_get_contents("../Resource/index.html");
    echo $body;
}

// $desc = new \App\Controller\TableInfo;
// $desc->main();