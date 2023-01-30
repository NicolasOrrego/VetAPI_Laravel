<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rjaulas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_paciente')
            ->nullable()
            ->contrained('pacientes')
            ->cascadeOnUpdate()
            ->nullOnDelete();
            $table->foreignId('id_usuario')
            ->nullable()
            ->contrained('users')
            ->cascadeOnUpdate()
            ->nullOnDelete();
            $table->foreignId('id_jaula')
            ->nullable()
            ->contrained('jaulas')
            ->cascadeOnUpdate()
            ->nullOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('rjaulas');
    }
};
