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
        Schema::create('ideas', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users');
            $table->text('description');
            $table->binary('main_image')->nullable();
            $table->char('money_need',30);
            $table->char('money_got',30);
            $table->unsignedBigInteger('love');
            $table->binary('img_1')->nullable();
            $table->binary('img_2')->nullable();
            $table->binary('img_3')->nullable();
            $table->binary('img_4')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ideas');
    }
};
