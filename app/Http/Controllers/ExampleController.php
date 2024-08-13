<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Student;
use Illuminate\support\Facades\DB;

class ExampleController extends Controller
{
 function login(){
    return view('login');
}
function logintask(){
    return view('logintask');
}
function receive(Request$request){
    dd($request->all());
    return $request['email'] . '<br>'. $request->pwd;

}
function cv(){
    return view ('cv');
}
function uploadForm(){
    return view ('upload');
}


public function index(){
    return view ('index');
}


public function about(){
    return view ('about');
}
public function test(){
    // dd (student::find(1)?->phone->phone_number);



function logintask1() {

}
}
}