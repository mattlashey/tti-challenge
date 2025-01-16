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
            $table->id(); // Primary Key
            $table->foreignId('project_id')->constrained()->onDelete('cascade'); // Foreign Key
            $table->string('title'); // Task title
            $table->text('description')->nullable(); // Optional description
            $table->string('assigned_to')->nullable(); // Optional assignee
            $table->date('due_date')->nullable(); // Due date
            $table->enum('status', ['to_do', 'in_progress', 'done']); // Status
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
