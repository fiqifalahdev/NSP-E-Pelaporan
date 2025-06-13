<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HiradcModel extends Model
{
    protected $table = 'hiradc_tables';
    protected $primaryKey = 'id';
    public $timestamps = false;

    protected $fillable = [
        'identifikasi_lokasi',
        'identifikasi_aktifitas',
        'identifikasi_potensi_bahaya',
        'identifikasi_dampak_bahaya',
        'identifikasi_PIC',
        'control_uraian',
        'control_poin_kemungkinan',
        'control_poin_keparahan',
        'control_nilai_resiko',
        'recom_uraian',
        'recom_poin_kemungkinan',
        'recom_poin_keparahan',
        'recom_nilai_resiko',
    ];
}
