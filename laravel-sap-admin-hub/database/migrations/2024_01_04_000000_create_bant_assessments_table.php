<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('bant_assessments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('lead_id')->constrained('leads')->onDelete('cascade');
            $table->integer('budget_score')->default(0)->comment('1-10');
            $table->integer('authority_score')->default(0)->comment('1-10');
            $table->integer('need_score')->default(0)->comment('1-10');
            $table->integer('timeline_score')->default(0)->comment('1-10');
            $table->text('budget_notes')->nullable();
            $table->text('authority_notes')->nullable();
            $table->text('need_notes')->nullable();
            $table->text('timeline_notes')->nullable();
            $table->integer('overall_score')->default(0)->comment('calculated 1-10');
            $table->enum('recommendation', ['qualified', 'needs_follow_up', 'not_qualified'])->default('needs_follow_up');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('bant_assessments');
    }
};
