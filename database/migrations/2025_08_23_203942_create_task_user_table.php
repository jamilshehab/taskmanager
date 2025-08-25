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
        Schema::create('agent_task', function (Blueprint $table) {
            $table->id();
             // Link to users
             $table->foreignId('user_id')
      ->constrained('users')   // reference users table
      ->onDelete('cascade');

$table->foreignId('task_id')
      ->constrained('tasks')   // reference tasks table
      ->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('agent_task');
    }
};
