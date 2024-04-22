<?php

namespace App\Http\Controllers;

use App\Models\CommonChat;
use App\Models\Person;
use App\Models\MembersComChat;
use Illuminate\Http\Request;

class CommonChatController extends Controller
{
    public function createComChat(Request $request)
    {
        $data = $request->validate([
        'name' => 'required|max:255',
        'description' => 'required|max:255',
        ]);

        $common_chat = CommonChat::firstOrCreate(
            [
                "name" => $data["name"],
                "description" => $data["description"]
            ],
            [
                "name" => $data["name"],
                "description" => $data["description"],
                "admin" => auth()->user()->id
            ]
        );

        MembersComChat::create([
            "id_chat" => $common_chat["id"],
            "id_user" => auth()->user()->id
        ]);



        return response(["message" => "ready"], 200);
    }
    public function showComChat()
    {
        $allChatsForPerson = Person::find(auth()->user()->id)->commonchats()->get();
        for($i = 0; $i < count($allChatsForPerson); $i++)
        {
                $allChatsForPerson[$i]["members"] = count(MembersComChat::get()->where("id_chat", $allChatsForPerson[$i]->id));
        }
        return $allChatsForPerson;
    }
}
