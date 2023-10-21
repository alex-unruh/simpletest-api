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
        Schema::create('tests', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('task_link')->nullable();
            $table->foreignId('release_id')->nullable();
            $table->foreignId('requested_by');
            $table->foreignId('created_by');
            $table->foreignId('assigned_to')->nullable();
            $table->longText('test_description');
            $table->text('impact_analysis');
            $table->text('configuration');
            $table->text('environment');
            $table->unsignedTinyInteger('status');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tests');
    }
};
