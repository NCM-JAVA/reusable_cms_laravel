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
            $table->string('name');
            $table->string('user_name');
            $table->string('login_name')->unique();;
            $table->bigInteger('parent_id')->default(0);
            $table->tinyInteger('user_status')->default(0);
            $table->string('email')->unique();
            $table->date('date')->nullable();
            $table->date('last_login_date')->nullable();
            $table->string('designation')->nullable();
            $table->string('user_type')->nullable();
            $table->string('clerk_type')->nullable();
            $table->string('department')->nullable();
            $table->tinyInteger('flag_id')->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->rememberToken();
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
