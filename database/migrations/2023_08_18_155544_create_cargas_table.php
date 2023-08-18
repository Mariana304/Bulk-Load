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
        Schema::create('cargas', function (Blueprint $table) {
            $table->id();
            $table->string('timestamps_old')->nullable();
            $table->integer('ticket_number');
            $table->integer('ticket_id');
            $table->integer('rating');
            $table->string('status');
            $table->mediumText('comments')->nullable();
            $table->string('date');
            $table->string('user_ip');      
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cargas');
    }
};
