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
        Schema::create('comments', function (Blueprint $table) {
            $table->id();

            // Relación con los casos de soporte
            $table->foreignId('support_case_id')->constrained('supportcases')->onDelete('cascade');
            
            // Relación con el agente que realiza el comentario
            $table->foreignId('agent_id')->constrained('users')->onDelete('cascade');

            // Comentario
            $table->json('comments')->default('[]');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('comments');
    }
};
