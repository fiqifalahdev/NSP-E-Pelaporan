<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ToolboxMeeting extends Model
{
    use HasFactory;

    protected $fillable = [
        'tanggal',
        'uraian_aktivitas',
        'penanggung_jawab',
        'keterangan',
        'kehadiran',
        'jabatan',
        'status', // New field added for status
    ];

    protected $casts = [
        'tanggal' => 'date',
        'kehadiran' => 'array', // cast JSON to array
    ];
}
