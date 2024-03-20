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
        Schema::create('peoples', function (Blueprint $table) {
            $table->id();
            $table->string("first_name");
            $table->string("second_name");
            $table->string("avatar")->default("../img/no_avatar.png");
            $table->string("city")->default("Just void");
            $table->string("country")->default("Just void");
            $table->text("description")->nullable();
            $table->text("hobbies")->nullable();
            $table->date("date_born")->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('peoples');
    }
};
