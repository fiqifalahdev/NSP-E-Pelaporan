<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('hiradc_tables', function (Blueprint $table) {
            $table->id();
            $table->text('identifikasi_lokasi');
            $table->text('identifikasi_aktifitas');
            $table->text('identifikasi_potensi_bahaya');
            $table->text('identifikasi_dampak_bahaya');
            $table->string('identifikasi_PIC');
            $table->text('control_uraian');
            $table->integer('control_poin_kemungkinan');
            $table->integer('control_poin_keparahan');
            $table->integer('control_nilai_resiko')->nullable();
            $table->text('recom_uraian');
            $table->integer('recom_poin_kemungkinan');
            $table->integer('recom_poin_keparahan');
            $table->integer('recom_nilai_resiko')->nullable();
            $table->enum('status', ['verified', 'unverified', 'process', 'waiting'])->default('waiting');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('hiradc_tables');
    }
};
