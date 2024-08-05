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
        Schema::create('smsreader_format', function (Blueprint $table) {
            $table->id();

            $table->char('title', 255);
            $table->char('slug', 255);
            $table->string('format');
            $table->string('fields_str');
            $table->enum('action', ['payment', 'confirming', 'account', 'withdraw', 'others'])->nullable();
            $table->integer('ordering')->default(5);
            $table->tinyInteger('published')->default(true);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('smsreader_format');
    }
};
