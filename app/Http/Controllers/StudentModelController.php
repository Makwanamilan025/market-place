<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class StudentModelController extends Controller
{
    public function index(){
            
    }

    public function store(Requset $request)
    {

        dd($request->all());
        $input = $request->all();
    }
}
