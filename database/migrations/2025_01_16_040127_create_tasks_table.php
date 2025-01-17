<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // id (primary key, auto-increment)
        // project_id (foreign key referencing projects)
        // title (string, required)
        // description (text, optional)
        // assigned_to (string, optional)
        // due_date (date, optional)
        // status (e.g., to_do, in_progress, done)
        Schema::create('tasks', function (Blueprint $table) {
            $table->id();
            $table->foreignId('project_id')->constrained('projects')->onDelete('cascade');
            $table->string('title');
            $table->text('description')->nullable();
            $table->string('assigned_to')->nullable();
            $table->date('due_date')->nullable();
            $table->enum('status', ['to_do', 'in_progress', 'done'])->default('to_do');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('tasks');
    }
};
