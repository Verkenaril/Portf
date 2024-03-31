<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\Person;
use App\Models\User;
use App\Models\Country;
use App\Http\Resources\SettingResource;
use App\Http\Resources\CityResource;
use App\Http\Resources\PeopleResource;
use App\Http\Resources\GalleryResource;


class SettingController extends Controller
{
    public function getSetting()
    {
        return ["user_info" =>(new SettingResource(Person::find(auth("sanctum")->user()->id)))->resolve(),
        "cities" => CityResource::collection(Country::find(1)->cities()->get())->resolve(),
        "media" => GalleryResource::collection(Person::find(auth()->user()->id)->gallery()->get())->resolve(),
        ];
    }
    public function getAccount()
    {
        $data = User::find(auth("sanctum")->user()->id);
        unset($data["email_verified_at"], $data["created_at"], $data["updated_at"]);
        return $data;
    }
    public function getSettingCity()
    {

    }
    public function setSetting(Request $request)
    {
        $request->validate([
            "first_name_inp" => "nullable|string",
            "second_name_inp" => "nullable|string",
            "date_born_inp" => "nullable|string",
            "city_inp" => "nullable|string",
            "country_inp" => "nullable|string",
            "hobbies_inp" => "nullable|string",
            "description_inp" => "nullable|string",
            
        ]);
        
        
        
        $data = $request->all();
        if($request->hasFile("photo"))
        {
            $path = "u_" . auth("sanctum")->user()->id;
            $name = $request->photo->hashName();
            $request->photo->storeAs("/$path", $name);

            Person::where("id", auth("sanctum")->user()->id)
            ->update(["avatar" => "../storage/$path/$name"]);
        }
        
        Person::where("id", auth("sanctum")->user()->id)
        ->update([
            "first_name" => $data["first_name_inp"],
            "second_name" => $data["second_name_inp"],
            "date_born" => $data["date_born_inp"],
            "city" => $data["city_inp"],
            "country" => $data["country_inp"],
            "description" => $data["description_inp"],
            "hobbies" => $data["hobbies_inp"],
        ]);
        return "ready";
    }
}
