<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Models\SavedToken;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


Route::group(["middleware" => "auth:sanctum"], function()
{
    Route::get("/getSetting", [App\Http\Controllers\SettingController::class, "getSetting"]);
    Route::get("/getAccountName", [App\Http\Controllers\SettingController::class, "getAccount"]);
    Route::get("/getChats", [App\Http\Controllers\ChatController::class, "showChats"]);
    Route::get("/getUser/id{id}", [App\Http\Controllers\GetPeoplesController::class, "getUser"]);
    Route::get("/getFriends", [App\Http\Controllers\FriendController::class, "getFriends"]);
    Route::get("/getPeoples", [App\Http\Controllers\GetPeoplesController::class, "getPeoples"]);
    Route::get("/getMessage", [App\Http\Controllers\MessageController::class, "getMessage"]);
    Route::get("/getMoreMessage", [App\Http\Controllers\MessageController::class, "getMoreMessage"]);
    Route::get("/getGallery", [App\Http\Controllers\GalleryController::class, "showGallery"]);
    

    Route::delete("/deleteMedia/{id}", [App\Http\Controllers\GalleryController::class, "delMedia"]);
    Route::delete("/deleteFriend/{id}", [App\Http\Controllers\FriendController::class, "deleteFriend"]);
    
    Route::post("/addFriend/{id}", [App\Http\Controllers\FriendController::class, "addFriend"]);
    Route::post("/setSetting", [App\Http\Controllers\SettingController::class, "setSetting"]);
    Route::post("/sendMessage", [App\Http\Controllers\MessageController::class, "sendMessage"]);
    Route::post("/uploadGallery", [App\Http\Controllers\GalleryController::class, "uploadFile"]);
});

Route::get('/test', [App\Http\Controllers\TestController::class, "index"]);
Route::post('/test', [App\Http\Controllers\TestController::class, "store"]);


Route::post("/addtoken", function (Request $request) {
    SavedToken::create([
        "saved_token" => property_exists(auth("sanctum")->user()->currentAccessToken(), "plainTextToken"),
        "user_id" => auth("sanctum")->user()->id
    ]);
});
Route::post("/existuser", App\Http\Controllers\CheckExistUserController::class);


