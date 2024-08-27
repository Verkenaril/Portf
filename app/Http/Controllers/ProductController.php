<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Smartfony;
use App\Models\Product;


class ProductController extends Controller
{
    public function index(string $id)
    {
        return view("products", ["data" => $this->choice($id), "id" => $id]);
    }
    public function show(string $id, string $el)
    {
        $r = $this->choiceProduct($id, $el);
        $descr = $r[0];
        $data = $r[1];
        // dd($data);
        return view("smartfony", compact("descr", "data"));
    }
    public function choice($id)
    {
        $columns = ["id", "price", "name", "picture", "raiting", "num_raiting"];
        $data = Product::where("type_product", $id)->paginate(4, $columns);
        // dd($data);
        foreach($data as $value)
        {
            $value["in_mounth"] = round($value["price"]/12);
        }
        return $data;
    }
    public function choiceProduct(string $id, string $el)
    {
        $arr = [new Smartfony];
        $data = $arr[$id-1]::find($el);
        unset($data["created_at"], $data["updated_at"], $data["created_at"]);
        $descr = json_decode($data["characteristic"]);
        unset($data["characteristic"]);
        return [$descr, $data];
    }
}
