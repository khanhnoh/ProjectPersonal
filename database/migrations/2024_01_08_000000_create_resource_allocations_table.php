<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('resource_allocations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('timeline_id')->constrained('timelines')->onDelete('cascade');
            $table->string('resource_name');
            $table->string('role')->nullable()->comment('Developer, QA, PM, etc.');
            $table->integer('allocation_percentage')->default(0);
            $table->date('start_date');
            $table->date('end_date');
            $table->text('notes')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('resource_allocations');
    }
};
