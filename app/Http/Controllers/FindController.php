<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class FindController extends Controller
{
    public function index(Request $request)
    {
        $columns = ["id", "price", "name", "picture", "raiting", "num_raiting"];
        $query = $request->input("query");
        $data = Product::where("name", "LIKE", "%$query%")->paginate(4, $columns);

        return view("findresult", ["data" => $data]);
    }

}
