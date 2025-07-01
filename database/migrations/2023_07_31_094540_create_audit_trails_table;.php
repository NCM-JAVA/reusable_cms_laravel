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
        Schema::create('audit_trails', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('user_login_id');
            $table->bigInteger('page_id')->nullable();
            $table->string('page_name')->nullable();
            $table->string('page_action');
            $table->string('page_category')->nullable();
            $table->time('page_action_date');
            $table->string('ip_address');
            $table->integer('lang');
            $table->string('page_title');
            $table->tinyInteger('approve_status');
            $table->string('usertype')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('audit_trails');
    }
};
