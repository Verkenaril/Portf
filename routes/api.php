<?php




use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Models\Vacancy;
use App\Models\Smartfony;
use App\Models\Product;


Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::get("/vacancies", function() { return Vacancy::all();});

// Заменить таблицу смартонов на общую
Route::post("/addsmart", function(Request $request) {
    $data = $request->input();
    Product::create(
        [
            "characteristic" => json_encode($data),
            "type_product" => "4"
        ]);
    return response()->json("ok");
});