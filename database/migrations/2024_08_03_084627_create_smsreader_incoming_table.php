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
        Schema::create('smsreader_incoming', function (Blueprint $table) {
            $table->id();

            $table->char('phone', 255);
            $table->string('message');
            $table->datetime('date_sent')->nullable();
            $table->datetime('date_received')->nullable();
            $table->string('sim')->nullable();
            $table->foreignId('gateway_id')->constrained('sms_gateway')->onDelete('cascade')->nullable()->index('smsreader_incoming_gateway_id');
            $table->string('params')->nullable();
            $table->enum('action', ['payment', 'confirming', 'account', 'withdraw', 'others'])->nullable();
            $table->tinyInteger('is_payment')->nullable()->default(0);
            $table->tinyInteger('completed')->nullable()->default(0);
            $table->tinyInteger('successful')->nullable()->default(0);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('smsreader_incoming');
    }
};
