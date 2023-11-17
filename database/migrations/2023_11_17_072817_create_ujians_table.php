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
        Schema::create('ujian', function (Blueprint $table) {
            $table->id();
            $table->string('nim')->nullable();
            $table->unsignedInteger('matkul_id')->nullable();
            $table->date('tanggal_ujian');
            $table->string('nilai');
            $table->enum('grade', ['A','B','C','D','E']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('ujian', function (Blueprint $table) {
            $table->dropIfExists('ujian');
            $table->dropForeign(['nim']);
            $table->dropForeign(['matkul_id']);
        });
    }
};
