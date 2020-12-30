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
         
          $count=$leftover=0;
          $getCode = new GenerateCode($timer['unique_code']);

          while($count < $timer['unique_code'])
          {
            if($count > 0)
            {
              $leftover = $timer['unique_code'] - $count; // get leftover unique code needed to do           
              $getCode = new GenerateCode($leftover);
            }

            foreach (array_chunk($getCode->unique_code,10000) as $t)  
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
    }

}

class GenerateCode {
  
  public $unique_code = array();

  function __construct($iteration) {
    for($i=0;$i<$iteration;$i++)
    {
      $str = '1234567890ABCDEFGHIJKLMNOPQRSTUVWXYZabcefghijklmnopqrstuvwxyz';
      array_push($this->unique_code,array('unique_code'=> substr(str_shuffle($str), 0, 7)));
    }
    return $this->unique_code;
  }
}