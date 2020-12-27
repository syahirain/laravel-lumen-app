<?php

namespace App\Http\Controllers;
use App\Timer;
use Illuminate\Http\Request;
use Illuminate\Database\QueryException;

class TimerController extends Controller
{

    public function create(Request $request)
    {
        $timer = $request->input();
          $a=array();
          $count=$leftover=0;
          for($i=0;$i<$timer['unique_code'];$i++)
          {
            $str = '1234567890ABCDEFGHIJKLMNOPQRSTUVWXYZabcefghijklmnopqrstuvwxyz';
          //  $str = '123';
            array_push($a,array('unique_code'=> substr(str_shuffle($str), 0, 7)));
          }


          while($count < $timer['unique_code'])
          {
            if($count > 0)
            {
              $leftover = $timer['unique_code'] - $count; // get leftover unique code needed to do
              $a=array(); // clear out old array
            }

            for($i=0;$i<$leftover;$i++)
            {
              $str = '1234567890ABCDEFGHIJKLMNOPQRSTUVWXYZabcefghijklmnopqrstuvwxyz';
              array_push($a,array('unique_code'=> substr(str_shuffle($str), 0, 7)));
            }

            foreach (array_chunk($a,10000) as $t)  
              {
                  try {
                      // Validate the value..
                      Timer::insert($t);
                      $count += count($t);
                  } catch (QueryException $e){
                    $errorCode = $e->errorInfo[1];
                    if($errorCode == 1062){
                      continue;  
                    }else{
                      return response()->json($errorCode);
                    }
                    
                  }
              }
          }
          
        return response()->json($count);
        //return response()->json($timer);
        //return var_dump($timer);
       //return $timer;
    }

}