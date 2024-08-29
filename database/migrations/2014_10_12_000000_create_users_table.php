<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    
     public function up()
{
    Schema::create('users', function (Blueprint $table) {
        $table->id();
        $table->string('name');
        $table->string('email')->unique();
        $table->text('about_me')->nullable();
        $table->string('instagram_profile')->nullable();
        $table->timestamp('email_verified_at')->nullable();
        $table->string('password');
        $table->string('image_path')->nullable(); // Adding image_path column
        $table->string('country')->nullable(); // Adding country column
        $table->string('address')->nullable(); // Adding address column
        $table->string('phone')->nullable(); // Adding phone column
        $table->rememberToken();
        $table->timestamps();
    });
}


    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
};
