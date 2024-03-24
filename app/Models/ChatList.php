<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ChatList extends Model
{
    use HasFactory;
    protected $guarded = false;

    public function test()
    {
        return $this->belongsToMany(Person::class, "chat_lists", "user_auth", "user_other");
    }
}
