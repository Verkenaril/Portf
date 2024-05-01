<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Person;

class PostController extends Controller
{
    public function createPost(Request $request)
    {
        $data = $request->validate([
            "name" => "required|string",
            "post" => "required|string"
        ]);
        Post::create([
            "name" => $data["name"],
            "post" => $data["post"],
            "user_id" => auth()->user()->id
        ]);
        return $data;
    }
    public function getPosts()
    {
        return Person::find(auth()->user()->id)->posts()->get();
    }
    public function savePost(Request $request)
    {
        $data = $request->validate([
            "name" => "required|string",
            "post" => "required|string",
            "id" => "required|integer",
        ]);
        $post = Post::find(1);
        $post->name = $data['name'];
        $post->post = $data['post'];
        $post->save();
        return response(["msg"=> "ready", "status" => 200]);
    }
    public function deletePost(string $id)
    {
        $post = Post::find($id);
        $post->delete();
        return response(["msg"=> "ready", "status" => 200]);
    }
}
