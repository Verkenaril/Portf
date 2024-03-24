<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('chat_lists', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("chat_id");
            $table->unsignedBigInteger("user_auth");
            $table->unsignedBigInteger("user_other");
            $table->timestamps();

            $table->foreign("chat_id")->references("id")->on("chats");
            $table->foreign("user_auth")->references("id")->on("peoples");
            $table->foreign("user_other")->references("id")->on("peoples");
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('chat_lists');
    }
};
