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
        Schema::create('safety_patrols', function (Blueprint $table) {
            $table->id();
            $table->string('kriteria');
            $table->string('lokasi');
            $table->enum('temuan', ['Safe', 'Unsafe Action', 'Unsafe Condition']);
            $table->date('tanggal');
            $table->enum('kesesuaian', ['Baik', 'Buruk']);
            $table->string('risiko')->nullable();
            $table->string('tindak_lanjut')->nullable();
            $table->string('foto_temuan')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('safety_patrols');
    }
};
