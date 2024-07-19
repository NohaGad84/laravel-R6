<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ExampleController;
use App\Http\Controllers\CarController;
use App\Http\Controllers\ClasseController;

Route::get('/logintask', [ExampleController::class,'logintask']);
Route::post('data1', [ExampleController::class,'receive'])->name('data');

// Route::get('cv', [ExampleController::class,'cv']);

// Route::get('',function(){
// return view('hello');
// });
// Route::get('cars/create',[CarController::class,'create'])->name('cars.store');
// Route::post('cars', [CarController::class,'store'])->name('cars.store');

Route::get('classes/create',[ClasseController::class,'create'])->name('classes.store');
Route::post('classes', [ClasseController::class,'store'])->name('classes.store');

// Route::get('/', function () {
//     return view('welcome');
// });

// Route::get('CV', function () {
//   return view('CV');
// });
Route::get('login', function () {
  return view('login');
});

 







// Route::get('cars/{id?}', function ($id=0) {
//     return "car number is ".$id;
// });->where([
//     'id' =>'[0-9]+'
// ]);

//or we can use whereNumber instead:
// Route::get('cars/{id?}', function ($id=0) {
//     return "car number is ".$id;
// })->whereNumber('id');
// Route::get('user/{name}/{age}', function ($id,$age) {
//     return "username is ".$name . "and age is ". $age;
// })->whereALpha('name')->whereNumber('age');

// Route::get('user/{name}/{age?}', function ($name,$age=0) {
//     if($age===0){
//     return "username is ".$name;
//  }
//  else
//  {
//     return "and age is ". $age;
//  }
// })->where([
//     'name'=>'[a-zA-Z]+',
//      'age' =>'[0-9]+'
// ]);
// Route::get('users/{name}', function($name){
//     return "name is ". $name;

// })->whereIn('name',['noha','ola','toqa']);

// Route::prefix('company')->group(function(){
//     Route::get('',function(){
//         return "company index";
//     });
//     Route::get('IT',function(){
//         return "company IT";
//     });
//     Route::get('users',function(){
//         return "company users";
//     });
// });



// //task 2

// Route::prefix('Accounts')->group(function(){
//     Route::get('admin',function(){
//         return "Account admin";
//     });

//     Route::get('user',function(){
//         return "Account user";
//     });

// });

// //part 2

// Route::prefix('Cars')->group(function () {
//     Route::prefix('USA')->group(function () {
//       Route::get('{carname}', function ($carname) {
//         return "USA $carname";
//       });
//     });
  
//     Route::prefix('GER')->group(function () {
//       Route::get('{carname}', function ($carname) {
//         return "GER $carname";
//       });
//     });
//   });
//fallback code:
// Route::fallback(function(){
//   return redirect('/');
// });

// Route::get('link', function () {
//   $url=route('w');
//   return "<a href='$url'>Go to welcome</a>";
// });
// Route::get('welcome', function () {
//   return "welcome to laravel";
// })->name('w');


// Route::post('/s1', function () {
  
//   return "data submitted successfully";

// })->name('submit');
