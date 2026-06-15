<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('effort_estimations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('scope_id')->constrained('scopes')->onDelete('cascade');
            $table->string('task_name');
            $table->float('estimated_hours')->default(0);
            $table->string('assigned_to')->default('TBD');
            $table->enum('status', ['draft', 'approved', 'in_progress'])->default('draft');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('effort_estimations');
    }
};
