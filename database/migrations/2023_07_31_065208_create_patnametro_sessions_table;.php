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
        Schema::create('patnametro_sessions', function (Blueprint $table) {
            $table->id();
            $table->string('ip_address');
            $table->binary('data');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('patnametro_sessions');
    }
};
