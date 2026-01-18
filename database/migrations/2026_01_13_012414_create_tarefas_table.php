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
        Schema::create('tarefas', function (Blueprint $table) {
            $table->id();
            $table->text('nome');
            $table->string('cliente');
            $table->text('observacao');
            $table->string('GP_realizar');
            $table->string('tipo');
            $table->string('projeto');
            $table->enum('status', ['Pendente', 'Apontada', 'Criada']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tarefas');
    }
};
