<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HelloController extends Controller
{
    //

    public function index(Request $request) {
        $param = 'Hello World!';

        return view('hello-world', ['alabala' => $param]);
    }
}
