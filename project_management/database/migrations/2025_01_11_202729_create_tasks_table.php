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
        Schema::create('tasks', function (Blueprint $table) {
            $table->id();
            $table->foreignId('project_id')->constrained()->onDelete('cascade'); // Foreign key referencing projects table
            $table->string('title'); // Title (string, required)
            $table->text('description')->nullable(); // Description (text, optional)
            $table->string('assigned_to')->nullable(); // Assigned to (string, optional)
            $table->date('due_date')->nullable(); // Due date (date, optional)
            $table->enum('status', ['to_do', 'in_progress', 'done']); // Status (enum, required)
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tasks');
    }
};
