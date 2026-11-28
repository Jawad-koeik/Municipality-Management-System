<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('requests', function (Blueprint $table) {
            $table->id();
            $table->foreignId('citizen_id')->constrained('citizens')->restrictOnDelete();
            $table->string('type', 50);
            $table->text('description')->nullable();
            $table->enum('status', ['pending', 'in_review', 'approved', 'rejected', 'completed'])->default('pending');
            $table->dateTime('submission_date');
            $table->dateTime('completion_date')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('requests');
    }
};
