<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;




class Person extends Model
{
    use HasFactory;
    protected $table = "peoples";
    protected $guarded = false;


    public function friends()
    {
        return $this->belongsToMany(Person::class, "friends", "user_id", "friend_id");
    }
    public function chats_for_smaller()
    {
        return $this->belongsToMany(Person::class, "chats", "user_smaller_id", "user_bigger_id");
    }
    public function chats_for_bigger()
    {
        return $this->belongsToMany(Person::class, "chats", "user_bigger_id","user_smaller_id");
    }
    public function sender()
    {
        return $this->hasMany(Message::class, "sender", "id");
    }
    public function chat_list()
    {
        return $this->belongsToMany(Person::class, "chat_lists", "user_auth", "user_other");
    }
    public function gallery()
    {
        return $this->hasMany(Gallery::class, "user_id", "id");
    }

    public function commonchats()
    {
        // return $this->hasMany(MembersComChat::class, "id_user", "id");
        return $this->belongsToMany(CommonChat::class, "members_com_chats", "id_user", "id_chat");
    }
    public function posts()
    {
        return $this->hasMany(Post::class, "user_id", "id");
    }
}
