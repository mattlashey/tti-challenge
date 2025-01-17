<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    //  id (primary key, auto-increment)
    //  title (string, required)
    //  description (text, optional)
    //  status (e.g., open, in_progress, completed)
    public function up(): void
    {
        Schema::create('projects', function (Blueprint $table) {
            $table->id();  // Primary key, auto-increment
            $table->string('title');  // Required
            $table->text('description')->nullable();  // Optional
            $table->enum('status', ['open', 'in_progress', 'completed'])
                ->default('open');  // Default status
            $table->timestamps(); // Created at updated at
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('projects');
    }
};
