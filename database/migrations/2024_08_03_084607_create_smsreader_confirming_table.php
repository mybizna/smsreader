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
        Schema::create('smsreader_confirming', function (Blueprint $table) {
            $table->id();

            $table->char('phone', 255);
            $table->char('code', 255);
            $table->char('name', 255);
            $table->datetime('date_sent');
            $table->foreignId('format_id')->nullable();
            $table->foreignId('incoming_id')->nullable();
            $table->decimal('amount', 20, 2)->nullable();
            $table->char('account', 255)->nullable();
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
        Schema::dropIfExists('smsreader_confirming');
    }
};
