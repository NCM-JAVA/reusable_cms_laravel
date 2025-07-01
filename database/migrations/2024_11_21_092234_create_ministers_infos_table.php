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
        Schema::create('ministers_infos', function (Blueprint $table) {
            $table->id();
            $table->tinyInteger('ministers_type')->default(0);
            $table->string('room_no', 255);
            $table->string('name', 255);
            $table->string('designation', 255)->nullable();
            $table->string('office_no', 255)->nullable();
            $table->string('intercom', 255)->nullable();
            $table->string('residence_no', 255)->nullable();
            $table->string('email', 255)->nullable();
            $table->tinyInteger('txtstatus');
            $table->tinyInteger('admin_id');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ministers_infos');
    }
};
