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
        Schema::create('chats', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("user_smaller_id");
            $table->unsignedBigInteger("user_bigger_id");
            $table->timestamps();

            $table->foreign("user_smaller_id")->references("id")->on("peoples");
            $table->foreign("user_bigger_id")->references("id")->on("peoples");
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('chats');
    }
};
