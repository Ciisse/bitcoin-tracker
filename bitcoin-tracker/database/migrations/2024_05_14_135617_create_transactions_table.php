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
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade'); // Foreign key linked to the users table
            $table->enum('type', ['buy', 'sell']); // Transaction type: buy or sell
            $table->decimal('amount', 16, 8); // Amount of bitcoins
            $table->decimal('price_per_unit', 16, 8); // Price per unit at the time of the transaction
            $table->decimal('total_cost', 16, 8); // Total cost of the transaction
            $table->timestamps(); // Automatically creates created_at and updated_at fields
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transactions');
    }
};
