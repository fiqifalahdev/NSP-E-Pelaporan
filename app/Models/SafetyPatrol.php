<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SafetyPatrol extends Model
{
    use HasFactory;

    protected $table = 'safety_patrols';

    protected $fillable = [
        'inspector',
        'klasifikasi_temuan',
        'kriteria',
        'lokasi',
        'tanggal',
        'kesesuaian',
        'risiko',
        'tindak_lanjut',
        'foto_temuan',
        'foto_tindak_lanjut',
        'status',
        'note',
    ];
}
