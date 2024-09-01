<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ExampleController;
use App\Http\Controllers\CarController;
use App\Http\Controllers\ClasseController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\ProductController;

Route::get('', function () {
  return view('welcome');
});

Route::get('contact-us', [ExampleController::class, 'login']);
Route::post('contact-us', [ExampleController::class, 'receive'])->name('data');



Route::prefix('products')->controller(ProductController::class)->as('products.')->group(function(){

Route::get('', 'index')->name('index');
Route::post('', 'store')->name('store');
Route::get('create', 'create')->name('create');
// Route::patch('{product}/edit','edit')->name('edit');
  Route::put('{product}/update','update')->name('update');
  // Route::get('{product}/show','show')->name('show');
  // Route::delete('{product}',  'destroy')->name('destroy');
  // Route::get('deleted',  'showDeleted')->name('showDeleted');
  // Route::patch('{id}',  'restore')->name('restore');
  // Route::delete('{product}/force-delete', 'forceDelete')->name('forceDelete');
  // Route::patch('/product/{id}',  'update');
});

Route::get('/logintask', [ExampleController::class,'logintask']);
Route::post('data1', [ExampleController::class,'receive'])->name('data');
Route::get('index', [ExampleController::class,'index']);
Route::get('about', [ExampleController::class,'about']);
Route::get('testonetoone', [ExampleController::class,'test']);

// Route::get('cv', [ExampleController::class,'cv']);

// Route::get('',function(){
// return view('hello');
// });
// Route::resource('cars', 'CarController')->middleware('verified');
Route::group(
  [
    'prefix' => LaravelLocalization::setLocale(),
    'middleware' => [ 'localeSessionRedirect', 'localizationRedirect', 'localeViewPath' ]
  ], function(){
     Route::prefix('cars')->controller(CarController::class)->as('cars.')->group(function(){

    Route::get('','index')->name('index');
     Route::get('create','create');
     Route::post('', 'store')->name('store');
     Route::get('{car}/edit','edit')->name('edit');
     Route::put('{car}/update','update')->name('update');
     Route::get('{car}/show','show')->name('show');
     Route::delete('{car}',  'destroy')->name('destroy');
     Route::get('deleted',  'showDeleted')->name('showDeleted');
     Route::patch('{id}',  'restore')->name('restore');
     Route::delete('{car}/force-delete', 'forceDelete')->name('forceDelete');
   });
   
  });

// Route::prefix('cars')->group(function(){
 


Route::get('uploadForm',[ExampleController::class,'uploadForm']);
Route::post('upload',[ExampleController::class,'upload'])->name('upload');


// Route::prefix('classes')->group(function(){
  Route::prefix('classes')->controller(ClasseController::class)->as('classes.')->group(function(){

Route::get('', 'index')->name('index');
Route::get('create', 'create');
Route::post('', 'store')->name('store');
Route::get('{classe}/edit','edit')->name('edit');
Route::put('{classe}/update','update')->name('update');
Route::get('{classe}/show','show')->name('show');
Route::delete('{classe}',  'destroy')->name('destroy');
Route::get('deleted',  'showDeleted')->name('showDeleted');
Route::patch('{id}',  'restore')->name('restore');
Route::delete('{classe}/force-delete',  'forceDelete')->name('forceDelete');
});

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
// Route::get('/download', function (Illuminate\Http\Request $request) {
//     $file = $request->input('file');
//     $path = public_path('assets/images/' . $file);

//     if (file_exists($path)) {
//         return response()->download($path);
//     } else {
//         abort(404, 'File not found');
//     }
// });

Auth::routes(['verify' => true]);
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('contact_us', [ContactController::class, 'contactform'])->name('contactform');
Route::post('contact_us', [ContactController::class, 'sendemail'])->name('sendemail');

