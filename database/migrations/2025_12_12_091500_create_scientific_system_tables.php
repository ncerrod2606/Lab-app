<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('investigadores', function (Blueprint $table) {
            $table->id();
            $table->string('nombre');
            $table->string('especialidad');
            $table->string('email')->unique();
            $table->text('biografia')->nullable();
            $table->string('imagen', 100)->unique()->nullable();
            $table->timestamps();
        });

        Schema::create('equipos', function (Blueprint $table) {
            $table->id();
            $table->string('nombre');
            $table->string('tipo'); 
            $table->enum('estado', ['disponible', 'en_uso', 'mantenimiento'])->default('disponible');
            $table->timestamps();
        });

        Schema::create('proyectos', function (Blueprint $table) {
            $table->id();
            $table->string('titulo');
            $table->text('descripcion');
            $table->date('fecha_inicio');
            $table->date('fecha_fin')->nullable();
            $table->enum('estado', ['planificacion', 'en_progreso', 'completado', 'cancelado'])->default('planificacion');
            $table->timestamps();
        });


        Schema::create('investigador_proyecto', function (Blueprint $table) {
            $table->id();
            $table->foreignId('investigador_id')->constrained('investigadores')->onDelete('cascade');
            $table->foreignId('proyecto_id')->constrained('proyectos')->onDelete('cascade');
            $table->timestamps();
        });

       
        Schema::create('experimentos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('proyecto_id')->constrained('proyectos')->onDelete('cascade');
            $table->foreignId('equipo_id')->nullable()->constrained('equipos')->onDelete('set null'); 
            $table->string('nombre');
            $table->date('fecha');
            $table->text('objetivo')->nullable();
            $table->text('resultados')->nullable();
            $table->timestamps();
        });

        Schema::create('notas_investigacion', function (Blueprint $table) {
            $table->id();
            $table->foreignId('experimento_id')->constrained('experimentos')->onDelete('cascade');
            $table->text('contenido');
            $table->timestamp('fecha_creacion')->useCurrent();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('notas_investigacion');
        Schema::dropIfExists('experimentos');
        Schema::dropIfExists('investigador_proyecto');
        Schema::dropIfExists('proyectos');
        Schema::dropIfExists('equipos');
        Schema::dropIfExists('investigadores');
    }
};
