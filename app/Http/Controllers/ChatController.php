<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Person;
use App\Models\Chat;
use App\Models\ChatList;


use App\Http\Resources\PeopleResource;

class ChatController extends Controller
{
    public function showChats()
    {
        $data = PeopleResource::collection(Person::find(auth()->user()->id)->chat_list()->get())->resolve();
        return $data;
    }
    
}
