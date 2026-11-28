<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('projects', function (Blueprint $table) {
            $table->id();
            $table->string('name', 150);
            $table->foreignId('department_id')->constrained('departments')->restrictOnDelete();
            $table->decimal('budget', 14, 2);
            $table->date('start_date');
            $table->date('end_date')->nullable();
            $table->enum('status', ['planned', 'in_progress', 'on_hold', 'completed', 'cancelled'])->default('planned');
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('tasks', function (Blueprint $table) {
            $table->id();
            $table->foreignId('project_id')->constrained('projects')->restrictOnDelete();
            $table->string('title', 150);
            $table->foreignId('assignee_id')->constrained('users')->restrictOnDelete();
            $table->enum('status', ['todo', 'in_progress', 'review', 'done'])->default('todo');
            $table->date('start_date')->nullable();
            $table->date('end_date')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('tasks');
        Schema::dropIfExists('projects');
    }
};
