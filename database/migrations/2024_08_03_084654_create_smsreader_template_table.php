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
        Schema::create('smsreader_template', function (Blueprint $table) {
            $table->id();

            $table->char('title', 255);
            $table->char('slug', 255);
            $table->string('template');
            $table->tinyInteger('published')->default(1);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('smsreader_template');
    }
};
