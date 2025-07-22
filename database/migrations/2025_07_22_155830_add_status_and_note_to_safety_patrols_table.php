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
            $table->enum('status', ['waiting', 'verified', 'unverified'])->default('waiting')->after('foto_temuan');
            $table->text('note')->nullable()->after('status');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('safety_patrols', function (Blueprint $table) {
            $table->dropColumn(['status', 'note']);
        });
    }
};
