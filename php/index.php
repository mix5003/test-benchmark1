<?php

function fibo1($number) {
    if($number <= 0) 
        return 0;
    if($number < 2) 
        return 1;

    return fibo1($number - 1) + fibo1($number - 2);
}

$path = strtok($_SERVER["REQUEST_URI"], '?');

switch($path){
    case '/hello': 
        echo "Hello World!";
        break;
    case '/fibo1': 
        echo fibo1($_GET['number']);
        break;
    case '/fibo2':
        $result = 0;
        if($_GET['number'] <= 0){
            $result = 0;
        }elseif($_GET['number'] <= 2){
            $result = 1;
        }else{
            $count = $_GET['number'];
            $num1 = 0;
            $num2 = 1;

            for ($i = 2; $i <= $count; $i++){
                $result = $num1 + $num2;
                $num1 = $num2;
                $num2 = $result;
            }
        }

        echo $result;
        break;
    case '/io':
        echo strlen(file_get_contents("http://nginx/index.html"));
        break;
}