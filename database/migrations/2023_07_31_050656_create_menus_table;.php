<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    //pushpendra /laukesh
    public function up(): void
    {
        Schema::create('menus', function (Blueprint $table) {
        $table->id();     
        $table->bigInteger('m_id')->nullable();
        $table->integer('m_type');
        $table->integer('m_flag_id')->nullable();
        $table->integer('menu_positions');
        $table->integer('language_id');
        $table->string('m_name')->nullable();
        $table->string('m_url')->nullable();
        $table->string('m_title')->nullable();
        $table->string('m_keyword');
        $table->string('m_description')->nullable();
        $table->longtext('content');
        $table->string('doc_uplode')->nullable();
        $table->string('linkstatus')->nullable();
        $table->time('start_date')->nullable();
        $table->time('end_date')->nullable();
        $table->tinyInteger('approve_status')->default(0);
        $table->integer('admin_id');
        $table->integer('page_postion')->nullable();
        $table->integer('current_version');
        $table->longtext('welcomedescription');
        $table->timestamps();

             });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('menus');
    }
};
