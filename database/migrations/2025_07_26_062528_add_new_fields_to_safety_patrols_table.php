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
        Schema::table('safety_patrols', function (Blueprint $table) {
            $table->string('inspector')->nullable()->after('id');
            $table->string('klasifikasi_temuan')->nullable()->after('inspector');
            $table->string('foto_tindak_lanjut')->nullable()->after('foto_temuan');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('safety_patrols', function (Blueprint $table) {
            $table->dropColumn(['inspector', 'klasifikasi_temuan', 'foto_tindak_lanjut']);
        });
    }
};
