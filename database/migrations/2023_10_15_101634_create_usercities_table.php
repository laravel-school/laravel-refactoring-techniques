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
        Schema::create('usercities', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('userid');
            $table->foreign('userid')->references('id')->on('users')->onDelete('cascade');
            $table->string('currentcity');
            $table->string('currentstate');
            $table->string('currentcountry');
            $table->string('currentlatlng');
            $table->string('previouscity1')->nullable();
            $table->string('previousstate1')->nullable();
            $table->string('previouscountry1')->nullable();
            $table->string('previouslatlng1')->nullable();
            $table->string('previouscity2')->nullable();
            $table->string('previousstate2')->nullable();
            $table->string('previouscountry2')->nullable();
            $table->string('previouslatlng2')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('usercities');
    }
};
