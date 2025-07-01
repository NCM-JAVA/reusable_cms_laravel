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
        Schema::create('officers', function (Blueprint $table) {
            $table->id();
            $table->string('officers_name')->nullable();
            $table->string('url')->nullable();
            $table->string('designation')->nullable();
            $table->longtext('contents')->nullable();
            $table->integer('language')->default(1);
            $table->string('txtuplode')->nullable();
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
        Schema::dropIfExists('officers');
    }
};
