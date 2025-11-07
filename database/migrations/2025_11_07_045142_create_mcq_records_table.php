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
        Schema::create('mcq_records', function (Blueprint $table) {
            $table->id();
            $table->integer('record_id');
            $table->integer('user_id');
            $table->integer('mcq_id');
            $table->enum('select_answer', ['a', 'b', 'c', 'd']);
            $table->integer('is_correct');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mcq_records');
    }
};
