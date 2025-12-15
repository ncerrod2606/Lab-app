<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up(): void
    {
        Schema::table('equipos', function (Blueprint $table) {
            $table->foreignId('investigador_id')->nullable()->constrained('investigadores')->onDelete('set null');
        });
    }


    public function down(): void
    {
        Schema::table('equipos', function (Blueprint $table) {
            $table->dropForeign(['investigador_id']);
            $table->dropColumn('investigador_id');
        });
    }
};
