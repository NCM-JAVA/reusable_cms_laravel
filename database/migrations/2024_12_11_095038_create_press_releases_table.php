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
        Schema::create('press_releases', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('url');
            $table->string('page_url');
            $table->integer('is_new');
            $table->integer('language');
            $table->integer('menutype');
            $table->string('metakeyword');
            $table->string('metadescription');
            $table->longText('description');
            $table->string('txtuplode');
            $table->string('txtweblink');
            $table->integer('txtstatus');
            $table->integer('admin_id');
            $table->date('start_date');
            $table->date('end_date');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('press_releases');
    }
};
