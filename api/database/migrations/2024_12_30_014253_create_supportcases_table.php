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
        Schema::create('supportcases', function (Blueprint $table) {
            $table->id();

            // Relación con el usuario solicitante
            $table->foreignId('requester_id')->constrained('users');
            
            // Relación con el agente de soporte
            $table->foreignId('agent_id')->nullable()->constrained('users');
            
            // Estado del caso
            $table->enum('status', [
                'created',
                'assigned',
                'in_progress',
                'finished'
            ])->default('created');
            
            // Fechas
            $table->timestamp('entry_date')->useCurrent();
            $table->timestamp('closed_at')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('supportcases');
    }
};
