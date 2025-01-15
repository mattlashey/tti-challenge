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
            $table->bigInteger('project_id', false, true);
            $table->foreign('project_id')
                ->references('id')->on('projects')
                ->onDelete('cascade')
                ->onUpdate('cascade');
            $table->string('title');
            $table->longText('description')->nullable();
            $table->string('assigned_to')->nullable();
            $table->dateTimeTz('due_date')->nullable();
            $table->enum('status', ['to_do', 'in_progress', 'done']);

            $table->timestamps(); // not specified, but this is useful if this was a real project
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
