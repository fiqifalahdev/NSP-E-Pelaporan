<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SafetyPatrol extends Model
{
    use HasFactory;

    protected $table = 'safety_patrols';

    protected $fillable = [
        'kriteria',
        'lokasi',
        'temuan',
        'tanggal',
        'kesesuaian',
        'risiko',
        'tindak_lanjut',
        'foto_temuan',
    ];
}
