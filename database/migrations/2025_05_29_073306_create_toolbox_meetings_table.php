<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateToolboxMeetingsTable extends Migration
{
    public function up(): void
    {
        Schema::create('toolbox_meetings', function (Blueprint $table) {
            $table->id();
            $table->date('tanggal');
            $table->text('uraian_aktivitas')->nullable();
            $table->string('penanggung_jawab')->nullable();
            $table->text('keterangan')->nullable();
            $table->json('kehadiran')->nullable(); // JSON array of names
            $table->string('jabatan')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('toolbox_meetings');
    }
}
