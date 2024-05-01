<?php

namespace App\Http\Controllers;

use App\Models\Person;
use App\Models\Friend;
use App\Models\Gallery;
use App\Http\Resources\PeopleResource;
use App\Http\Resources\SettingResource;
use App\Http\Resources\GalleryResource;
use Illuminate\Http\Request;

class GetPeoplesController extends Controller
{
    public function getPeoples(Request $request)
    {
        $exceptFriendsArray = [];
        $allFriendsUser = Friend::where("user_id", auth("sanctum")->user()->id)->get();
        
        foreach($allFriendsUser as $key => $value)
        {
            $exceptFriendsArray[] = $value->friend_id;
        }
        
        $data = Person::whereNot("id", auth("sanctum")->user()->id);
        foreach($exceptFriendsArray as $key => $value)
        {
            $data = $data->whereNot("id", $value);
        }

        return PeopleResource::collection($data->paginate(3, ["*"], "page", $request->query("page")));
    }
    public function getUser(string $id)
    {
        return ["user_info" => (new SettingResource(Person::find($id)))->resolve(),
        "media" => GalleryResource::collection(Person::find($id)->gallery()->get())->resolve()
        ];
    }
    public function getPostsUser(string $id)
    {
        return Person::find($id)->posts()->get();
    }
}
