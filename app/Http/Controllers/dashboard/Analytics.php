<?php

namespace App\Http\Controllers\dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class Analytics extends Controller
{
  public function index()
  {
    // 1. Ambil semua lokasi unik
    $lokasiList = DB::table('hiradc_tables')
      ->select('identifikasi_lokasi')
      ->distinct()
      ->pluck('identifikasi_lokasi')
      ->toArray();

    // 2. Definisikan kategori risiko
    $kategoriRisiko = [
      'Rendah' => [1, 3],
      'Sedang' => [4, 6],
      'Tinggi' => [7, 9],
      'Sangat Tinggi' => [10, 15],
    ];

    // 3. Inisialisasi struktur data awal
    $chartData = [];
    foreach ($lokasiList as $lokasi) {
      foreach ($kategoriRisiko as $kategori => $range) {
        $chartData[$lokasi][$kategori] = 0;
      }
    }

    // 4. Ambil semua data dan kelompokkan berdasarkan lokasi dan nilai risiko
    $allData = DB::table('hiradc_tables')
      ->select('identifikasi_lokasi', 'control_nilai_resiko')
      ->get();

    foreach ($allData as $row) {
      foreach (['control_nilai_resiko'] as $tipe) {
        $nilai = $row->{$tipe};
        foreach ($kategoriRisiko as $kategori => [$min, $max]) {
          if ($nilai >= $min && $nilai <= $max) {
            $chartData[$row->identifikasi_lokasi][$kategori]++;
            break;
          }
        }
      }
    }

    // 5. Ubah ke format chart Apex
    $series = [];
    foreach ($lokasiList as $lokasi) {
      $series[] = [
        'name' => $lokasi,
        'data' => array_values($chartData[$lokasi]),
      ];
    }

    $jumlahTemuanPerLokasi = DB::table('safety_patrols')
      ->select('lokasi', DB::raw('COUNT(*) as jumlah_temuan'))
      ->groupBy('lokasi')
      ->get();

    $jumlahTemuanPerKategori = DB::table('safety_patrols')
      ->select('temuan', DB::raw('COUNT(*) as jumlah_temuan'))
      ->groupBy('temuan')
      ->get();

    $toolboxStatusSummary = DB::table('toolbox_meetings')
      ->select('status', DB::raw('count(*) as jumlah'))
      ->groupBy('status')
      ->get();

    return view('content.dashboard.dashboards-analytics', [
      'series' => json_encode($series),
      'categories' => json_encode(array_keys($kategoriRisiko)),
      'temuanPerLokasi' => json_encode($jumlahTemuanPerLokasi),
      'temuanPerKategori' => json_encode($jumlahTemuanPerKategori),
      'toolboxStatusSummary' => json_encode($toolboxStatusSummary)
    ]);
  }
}
