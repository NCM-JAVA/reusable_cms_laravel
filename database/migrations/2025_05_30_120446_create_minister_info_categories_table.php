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
        Schema::create('minister_info_categories', function (Blueprint $table) {
            $table->id();
            $table->string('category_name');
            $table->tinyInteger('language')->default(1); // 1=English, 2=Hindi (optional logic)
            $table->tinyInteger('txtstatus')->default(1); // Status: 0=Inactive, 1=Active
            $table->tinyInteger('flag_id')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('minister_info_categories');
    }
};
