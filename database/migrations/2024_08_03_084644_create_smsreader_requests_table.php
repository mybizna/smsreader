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
        Schema::create('smsreader_requests', function (Blueprint $table) {
            $table->id();

            $table->foreignId('payment_id')->nullable();
            $table->char('phone', 255);
            $table->char('slug_str', 255);
            $table->string('message');
            $table->datetime('date_sent');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('smsreader_requests');
    }
};
