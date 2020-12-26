<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index()
    {
        return view('timer');
    }

    public function sendData(Request $request)
    {
        return 'hoi';
    }
}
