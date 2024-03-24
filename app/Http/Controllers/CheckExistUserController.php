<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class CheckExistUserController extends Controller
{
    public function __invoke(Request $request)
    {
        if(DB::table("users")->where("email", $request->input("email"))->exists())
        {
            return 1;
        }
        if(DB::table("users")->where("name", $request->input("name"))->exists())
        {
            return 1;
        }
        return 0;
    }
}
