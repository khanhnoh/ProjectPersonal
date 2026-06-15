<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('cost_estimations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('scope_id')->constrained('scopes')->onDelete('cascade');
            $table->decimal('hourly_rate', 12, 2)->default(0);
            $table->float('total_hours')->default(0);
            $table->decimal('labor_cost', 14, 2)->default(0);
            $table->decimal('material_cost', 14, 2)->default(0);
            $table->integer('markup_percentage')->default(0);
            $table->decimal('final_price', 14, 2)->default(0);
            $table->enum('currency', ['VND', 'USD'])->default('VND');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('cost_estimations');
    }
};
