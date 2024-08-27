<?php

use Illuminate\Support\Facades\Route;
use App\Models\Product;
use Illuminate\Http\Request;

use App\Http\Middleware\MyMiddleware;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\FindController;
 


// Route::get('/', function () {

//     $data = Product::all();
//     return view('product', ["data" => $data]);
// });

Route::get("/work", function() { return view("work");});

Route::get("/", function() { return view("catalog");});
Route::get("/catalog", function() { return view("catalog");});
Route::get("/addsmartfony", function() { return view("addpage.addsmartfony");});

Route::get("/findbrand/{brand}", [FindController::class, "indexbrand"]);
Route::get("/findresult", [FindController::class, "index"]);
Route::get("/secret", function() { return 1111; })->middleware(MyMiddleware::class);

Route::get("/products/{id}", [ProductController::class, "index"]);
Route::get("/products/{id}/{el}", [ProductController::class, "show"]);


Route::get("/entities", function() { return view("entities");});
Route::get("/payments", function() { return view("payments");});
Route::get("/credit", function() { return view("credit");});
Route::get("/career", function() { return view("career");});
Route::get("/policy", function() { return view("policy");});
Route::get("/about", function() { return view("about");});




Route::post('/qw', function (Request $request) {
    
    $data = $request->all();
    unset($data["_token"]);
    // dd($data);

    $q = Product::all();
    
    //filter price
    $min_price = $data["min_price"];
    $max_price = $data["max_price"];
    if($min_price != null) $q = $q->where("price", ">=", $data["min_price"]);
    if($max_price != null) $q = $q->where("price", "<=", $data["max_price"]);
    unset($data["min_price"]);
    unset($data["max_price"]);

    // dd($data);
    //esli net filtroB
    if($data == []) return view('product', ["data" => $q]);
    
    //esli estb filtrbl
    foreach($data as $key=>$value)
    {
        if(is_array($value))
        {
            $q = $q->whereIn($key, $value);
        }
        else $q = $q->where($key, $value);
    }


    return view('product', ["data" => $q]);
})->name("test");

