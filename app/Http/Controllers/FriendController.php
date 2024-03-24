<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Friend;
use App\Models\Person;

use App\Http\Resources\PeopleResource;

class FriendController extends Controller
{
    public function getFriends(Request $request)
    {
        
        $data = Person::find(auth("sanctum")->user()->id)->friends();    
        return PeopleResource::collection($data->paginate(3, ["*"], "page", $request->query("page")));
    }

    public function addFriend(string $id)
    {
        Friend::create([
            "user_id" => auth("sanctum")->user()->id,
            "friend_id" => $id
        ]);
        return response([]);
    }

    public function deleteFriend(string $id)
    {
        Friend::where("user_id", auth("sanctum")->user()->id)->where("friend_id", $id)->delete();
        return response([]);
    }
}
