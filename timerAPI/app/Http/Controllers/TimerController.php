<?php

namespace App\Http\Controllers;
use App\Timer;
use Illuminate\Http\Request;

class TimerController extends Controller
{

    public function create(Request $request)
    {
        $timer = $request->input();
          $a=array();
          for($i=0;$i<$timer['unique_code'];$i++)
          {
             $str = '1234567890ABCDEFGHIJKLMNOPQRSTUVWXYZabcefghijklmnopqrstuvwxyz';
            // $a['unique_code'] = substr(str_shuffle($str), 0, 7);
            // Timer::insert($a);
            array_push($a,array('unique_code'=> substr(str_shuffle($str), 0, 7)));
          }
          foreach (array_chunk($a,50000) as $t)  
            {
                //DB::table('table_name')->insert($t); 
                Timer::insert($t);
            }
          //Timer::insert($a);
        return response()->json('DONE QUERY', 201);
        //return response()->json($timer);
        //return var_dump($timer);
       //return $timer;
    }

}