<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('pitching_checklists', function (Blueprint $table) {
            $table->id();
            $table->foreignId('scope_id')->constrained('scopes')->onDelete('cascade');
            $table->text('checklist_item');
            $table->boolean('is_completed')->default(false);
            $table->string('assigned_to')->nullable();
            $table->date('due_date')->nullable();
            $table->text('notes')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pitching_checklists');
    }
};
