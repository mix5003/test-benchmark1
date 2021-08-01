<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class MainController extends Controller
{
    public function hello(){
        return "Hello World!";
    }

    public function fibo1(Request $request){
        return $this->calFibo1($request->get('number'));
    }

    public function fibo2(Request $request){
        $result = 0;
        $number = $request->get('number');
        if($number <= 0){
            $result = 0;
        }elseif($number <= 2){
            $result = 1;
        }else{
            $count = $number;
            $num1 = 0;
            $num2 = 1;

            for ($i = 2; $i <= $count; $i++){
                $result = $num1 + $num2;
                $num1 = $num2;
                $num2 = $result;
            }
        }

        return $result;
    }

    public function io(){
        return strlen(file_get_contents("http://nginx/index.html"));
    }

    private function calFibo1($number){
        if($number <= 0) 
            return 0;
        if($number < 2) 
            return 1;

        return $this->calFibo1($number - 1) + $this->calFibo1($number - 2);
    }
}
