<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('artifacts', function (Blueprint $table) {
            $table->id();
            $table->foreignId('scope_id')->constrained('scopes')->onDelete('cascade');
            $table->string('artifact_name');
            $table->text('description')->nullable();
            $table->string('file_path')->nullable();
            $table->enum('file_type', ['proposal', 'erd', 'wireframe', 'specification', 'other'])->default('other');
            $table->string('uploaded_by')->nullable();
            $table->timestamp('upload_date')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('artifacts');
    }
};
