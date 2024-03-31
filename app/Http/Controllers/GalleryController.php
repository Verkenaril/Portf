<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\Gallery;
use App\Models\Person;
use App\Http\Resources\GalleryResource;

class GalleryController extends Controller
{
    public function uploadFile(Request $request)
    {
        $user_path = "u_" . auth("sanctum")->user()->id;
        $name_file = $request->file("file1")->hashName();
        $fileType = $request->file("file1")->extension();

        $request->file("file1")->store("$user_path/media");

        $endedPath = "../storage/$user_path/media/" . $name_file;
        Gallery::create(
            [
                "user_id" => auth()->user()->id,
                "file" => $endedPath,
                "type_file" => $fileType
            ]);
        return "ready";
    }
    public function showGallery()
    {
        return GalleryResource::collection(Person::find(auth()->user()->id)->gallery()->get())->resolve();
    }
    public function delMedia(string $id)
    {
        Gallery::find($id)->delete();
        return "ready";
    }
}
