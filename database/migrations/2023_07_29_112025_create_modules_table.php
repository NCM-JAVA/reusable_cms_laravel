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
        Schema::create('modules', function (Blueprint $table) {
            $table->id();
            $table->integer('module_id')->nullable();
            $table->integer('submenu_id');
            $table->string('module_name');
            $table->string('icons');
            $table->string('slug');
            $table->integer('mod_order_id');
            $table->string('module_status');
            $table->integer('publish_id_module');
            $table->integer('module_language_id');
            $table->string('page_type')->nullable();
            $table->string('page_url');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('modules');
    }
};
