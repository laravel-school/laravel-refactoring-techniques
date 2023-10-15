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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->text('aboutme');
            $table->tinyInteger('hasapprovedaboutme');
            $table->text('lookingfordetails');
            $table->tinyInteger('hasapprovedlookingfor');
            $table->string('fullname');
            $table->string('birthday');
            $table->string('birthmonth');
            $table->string('birthyear');
            $table->string('gender', 10);
            $table->string('wanttobe', 50);
            $table->string('interest', 50);
            $table->string('lifestyle', 100);
            $table->string('networth', 100);
            $table->string('annualincome', 100);
            $table->string('username', 32);
            $table->tinyInteger('isusernameapproved');
            $table->string('email', 100);
            $table->string('password', 100);
            $table->string('profilephoto');
            $table->string('tagline');
            $table->tinyInteger('hasapprovedtagline');
            $table->string('activationcode', 128);
            $table->string('remember_token');
            $table->tinyInteger('flag');
            $table->tinyInteger('issuspended');
            $table->string('membershiptype', 50);
            $table->tinyInteger('isverifiedaccount');
            $table->tinyInteger('isfeatured');
            $table->tinyInteger('isloggedin');
            $table->tinyInteger('isdoteduemail');
            $table->tinyInteger('featurehome');
            $table->string('createdby');
            $table->string('issuspendedfor');
            $table->string('featuredin');
            $table->string('featuredsince');
            $table->timestamp('email_verified_at')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
