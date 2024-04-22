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
        Schema::create('members_com_chats', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("id_chat");
            $table->unsignedBigInteger("id_user");
            $table->timestamps();
            
            $table->foreign("id_chat")->references("id")->on("common_chats");
            $table->foreign("id_user")->references("id")->on("peoples");
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('members_com_chats');
    }
};
