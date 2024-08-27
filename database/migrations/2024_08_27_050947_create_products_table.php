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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->tinyText("brand")->nullable();
            $table->string("name", 200)->default(0);
            $table->string("picture", 300)->default(0);
            $table->string("price", 10)->default(0);
            $table->json("characteristic");
            $table->unsignedTinyInteger("raiting")->default(0);
            $table->unsignedMediumInteger("num_raiting")->default(0);
            $table->unsignedMediumInteger("old_price")->default(0);
            $table->unsignedTinyInteger("type_product")->default(0);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
