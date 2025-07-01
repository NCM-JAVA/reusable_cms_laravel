<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    //pushpendra
    public function up(): void
    {
        Schema::create('signups', function (Blueprint $table) {
            
            $table->id();
            $table->string('user_name');
            $table->string('login_name');
            $table->string('user_pass');
            $table->string('user_email');
            $table->string('user_phone');
            $table->date('user_dob');
            $table->string('user_status')->default(0);
            $table->datetime('last_login_date');
            $table->string('address');
            $table->datetime('dateadded');
            $table->tinyInteger('deleted');
            $table->datetime('deletedon');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('signups');
    }
};
