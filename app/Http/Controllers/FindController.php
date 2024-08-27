<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use Illuminate\Support\Facades\DB;


class FindController extends Controller
{
    public function index(Request $request)
    {
        $columns = ["id", "price", "name", "picture", "raiting", "num_raiting"];
        $query = $request->input("query");
        $data = Product::where("name", "LIKE", "%$query%")->paginate(4, $columns);

        return view("findresult", ["data" => $data]);
    }
    public function indexbrand(string $brand)
    {
        $columns = ["id", "price", "brand", "name", "picture", "raiting", "num_raiting"];
        $data = Product::where("brand", "$brand")->paginate(4, $columns);

        return view("findresult", ["data" => $data]);
    }
}
