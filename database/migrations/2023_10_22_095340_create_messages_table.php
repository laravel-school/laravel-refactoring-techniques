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
        Schema::create('messages', function (Blueprint $table) {
            $table->id();
            $table->text('message');
            $table->boolean('is_seen')->default(0);
            $table->boolean('isflagged')->default(0);
            $table->boolean('deleted_from_sender')->default(0);
            $table->boolean('deleted_from_receiver')->default(0);
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('conversation_id');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('messages');
    }
};
