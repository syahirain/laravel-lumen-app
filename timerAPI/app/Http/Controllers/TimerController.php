<?php

namespace App\Http\Controllers;
ini_set('memory_limit', '1024M');
use App\Timer;
use Illuminate\Http\Request;

class TimerController extends Controller
{

    public function create(Request $request)
    {
        $timer = $request->input();
        //settype($timer, "integer");
        //Timer::create($timer);     
        //Timer::insert($timer);
        //Timer::insert($timer);
         $a=array();
         for($i=0;$i<$timer['unique_code'];$i++){
             $a['unique_code'] = $timer['unique_code'];
             $a[] = new  Ingredient([
                'name' => $ingredient_names[$i],
                'other_field' => $ingredient_other_field[$i],
                'other_field2' => $ingredient_other_field2[$i],
            ]);
         }
        // $data = array(
        //     array('unique_code'=>'123'),
        //     array('unique_code'=>'123')
        // );
        Timer::insert($a);
        return response()->json($timer['unique_code'], 201);
        //return response()->json($timer);
        //return var_dump($timer);
       //return $timer;
    }

}