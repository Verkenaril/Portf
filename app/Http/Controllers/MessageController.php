<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Chat;
use App\Models\ChatList;
use App\Models\Message;
use App\Models\Person;
use App\Http\Resources\PeopleResource;
use App\Http\Resources\MessageResource;
use App\Events\MessageEvent;


class MessageController extends Controller
{

    public function sendMessage(Request $request)
    {
        $arr = [];
        $chat = null;
        $data = $request->validate([
            "user_other_id" => "required", "message" => "required", "chat_id" => "nullable|integer"]);
        
        $a = auth("sanctum")->user()->id;
        $b = $data["user_other_id"];
        


        if($a < $b)
        {
            $chat = Chat::firstOrCreate(
            [
                "user_smaller_id" => $a,
                "user_bigger_id" => $b
            ],
            [
                "user_smaller_id" => $a,
                "user_bigger_id" => $b
            ]);
        }
        else
        {
            $chat = Chat::firstOrCreate(
                [
                    "user_smaller_id" => $b,
                    "user_bigger_id" => $a
                ],
                [
                    "user_smaller_id" => $b,
                    "user_bigger_id" => $a
                ]);
        }
    
        $m = Message::create([
            "chat_id" => $chat->id,
            "sender" => $a,
            "message" => $data["message"]
        ]);

        ChatList::firstOrCreate(
            [
                "chat_id" => $chat->id,
                "user_auth" => $a,
                "user_other" => $b
            ],
            [
                "chat_id" => $chat->id,
                "user_auth" => $a,
                "user_other" => $b
            ]
        );

        ChatList::firstOrCreate(
            [
                "chat_id" => $chat->id,
                "user_auth" => $b,
                "user_other" => $a
            ],
            [
                "chat_id" => $chat->id,
                "user_auth" => $b,
                "user_other" => $a
            ]
        );


        broadcast(new MessageEvent($m, $b))->toOthers();
        return response([]);
    }

    public function getMessage(Request $request)
    {   
        $chat = null;
        $a = auth("sanctum")->user()->id;
        $b = $request->query("uoi");
        $c = $request->query("c_i");
        $howManyMsg = 16;

        $person = new PeopleResource(Person::find($b));

        if($c != 0)
        {
            $data = MessageResource::collection(Chat::find($c)->messages()->get()->sortByDesc("id")->take($howManyMsg)->reverse());

            return [
                "message" => $data,
                "person" => $person,
                "chat_id" => $chat->id
            ];
        }
        else if($a < $b)
        {
            $chat = Chat::firstOrCreate(
                [
                    "user_smaller_id" => $a,
                    "user_bigger_id" => $b
                ],
                [
                    "user_smaller_id" => $a,
                    "user_bigger_id" => $b
                ]);


            $chat = Chat::where("user_smaller_id", $a)->where("user_bigger_id", $b)->first();
            
            $data = MessageResource::collection(Chat::find($chat->id)->messages()->get()->sortByDesc("id")->take($howManyMsg)->reverse());

            return [
                "message" => $data,
                "person" => $person,
                "chat_id" => $chat->id,
            ];
        }
        else
        {

            $chat = Chat::firstOrCreate(
                [
                    "user_smaller_id" => $b,
                    "user_bigger_id" => $a
                ],
                [
                    "user_smaller_id" => $b,
                    "user_bigger_id" => $a
                ]);

            $chat = Chat::where("user_smaller_id", $b)->where("user_bigger_id", $a)->first();

            $data = MessageResource::collection(Chat::find($chat->id)->messages()->get()->sortByDesc("id")->take($howManyMsg)->reverse());

            return [
                "message" => $data,
                "person" => $person,
                "chat_id" => $chat->id
            ];
        }
    }
    public function getMoreMessage(Request $request)
    {
        $chat_id = $request->query("c_i");
        $skip_count = $request->query("skip");

        $howManyMsg = 16;
        $max_rows = Chat::find($chat_id)->messages()->get()->count();

        $difference = $max_rows - $skip_count;
        if($skip_count > $max_rows)
        {
            return "Все сообщения загружены";
        }
            $data = MessageResource::collection(Chat::find($chat_id)->messages()->get()->sortByDesc("id")->skip($skip_count)->take($howManyMsg));
            return ["message" => $data,
            "skip" => $skip_count];



    }    
}
