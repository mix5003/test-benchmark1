<?php

use Swoole\Http\Server;
use Swoole\Http\Request;
use Swoole\Http\Response;


function fibo1($number) {
    if($number <= 0) 
        return 0;
    if($number < 2) 
        return 1;

    return fibo1($number - 1) + fibo1($number - 2);
}


$server = new Swoole\HTTP\Server("0.0.0.0", 3000);

$server->on("Start", function(Server $server)
{
    echo "Swoole http server is started at http://127.0.0.1:3000\n";
});

$server->on("Request", function(Request $request, Response $response)
{    
    $response->header("Content-Type", "text/plain");


    switch($request->server['path_info']){
        case '/hello': 
            $response->end("Hello World!");
            return;
        case '/fibo1': 
            $response->end(fibo1($request->get['number']));
            return;
        case '/fibo2':
            $result = 0;
            if($request->get['number'] <= 0){
                $result = 0;
            }elseif($request->get['number'] <= 2){
                $result = 1;
            }else{
                $count = $request->get['number'];
                $num1 = 0;
                $num2 = 1;
    
                for ($i = 2; $i <= $count; $i++){
                    $result = $num1 + $num2;
                    $num1 = $num2;
                    $num2 = $result;
                }
            }
    
            $response->end($result);
            return;
        case '/io':
            $response->end(strlen(file_get_contents("http://nginx/index.html")));
            return;
    }
    $response->end('');
});

$server->start();