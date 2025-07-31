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
        Schema::table('donations', function (Blueprint $table) {
            // Drop the existing enum and recreate it with 'bank' added
            $table->enum('payment_method', ['mpesa', 'card', 'paypal', 'bank', 'other'])->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('donations', function (Blueprint $table) {
            // Revert back to original enum values
            $table->enum('payment_method', ['mpesa', 'card', 'paypal', 'other'])->change();
        });
    }
};
