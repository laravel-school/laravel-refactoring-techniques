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
        Schema::create('user_suspended', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('user_id');
            $table->dateTime('suspended_start')->nullable();
            $table->dateTime('suspended_end ')->nullable();
            $table->boolean('suspended')->default(0);
            $table->boolean('acknowledge')->default(0);
            $table->dateTime('acknowledge_time')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_suspended');
    }
};
