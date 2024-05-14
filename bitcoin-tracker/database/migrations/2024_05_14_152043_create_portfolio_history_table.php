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
        Schema::create('portfolio_history', function (Blueprint $table) {
            $table->id();
            $table->foreignId('portfolio_id')->constrained()->onDelete('cascade'); // Relationship with the portfolios table
            $table->decimal('balance', 16, 8); // Portfolio balance at the time of recording
            $table->timestamp('record_date')->useCurrent(); // Time of recording the entry
            $table->timestamps(); // Automatically creates created_at and updated_at fields
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('portfolio_history');
    }
};
