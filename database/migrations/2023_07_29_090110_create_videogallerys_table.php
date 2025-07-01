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
        Schema::create('videogallerys', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->integer('language');
            $table->string('txtuplode')->default(0);
            $table->integer('txtstatus');
            $table->integer('admin_id');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('videogallerys');
    }
};
