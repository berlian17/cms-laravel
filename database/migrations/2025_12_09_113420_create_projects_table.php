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
        Schema::create('projects', function (Blueprint $table) {
            $table->id();
            $table->string('industrial_type');
            $table->string('title');
            $table->string('slug')->unique();
            $table->string('cover_img');
            $table->string('service_name');
            $table->date('completion_date')->nullable();
            $table->text('description')->nullable();
            $table->string('client_name')->nullable();
            $table->string('location')->nullable();
            $table->string('duration')->nullable();
            $table->tinyInteger('status')->default(1);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('projects');
    }
};
