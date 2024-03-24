<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
// Route::get("/", function() {return view("main");});

use App\Models\Chat;
use App\Models\Person;

Auth::routes();



Route::get('/testim', function () {
    
    dd(Chat::find(1)->messages()->get()->sortByDesc("id")->skip(40)->take(10)->reverse());
    // dd(get_class_methods(Chat::find(1)->messages()->get()));
     return view('main'); 
    });

Route::get('{page}', function () { return view('main'); })->where("page", ".*");


// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
