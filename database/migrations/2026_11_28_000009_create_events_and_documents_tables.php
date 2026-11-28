<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('events', function (Blueprint $table) {
            $table->id();
            $table->string('title', 150);
            $table->text('description');
            $table->dateTime('date');
            $table->string('target_audience', 100);
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('documents', function (Blueprint $table) {
            $table->id();
            $table->string('title', 150);
            $table->string('link', 500);
            $table->foreignId('uploaded_by')->constrained('users')->restrictOnDelete();
            $table->string('related_entity', 100);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('documents');
        Schema::dropIfExists('events');
    }
};
