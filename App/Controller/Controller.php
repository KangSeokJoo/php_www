<?php
namespace App\Controller;

Abstract class Controller
{
    // interface 와 유사하게 선언을 할 수 있어요.
    Abstract public function main();

    // 추상화는 메소드 설정할 수 있어요.
    public function hello()
    {
        echo "안녕 대림대 php 강좌";
    }
}