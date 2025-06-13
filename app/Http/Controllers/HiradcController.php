<?php

namespace App\Http\Controllers;

use App\Models\HiradcModel as Hiradc;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;

class HiradcController extends Controller
{
    public function index()
    {
        $hiradcs = Hiradc::all();

        // Tambah Paginasi
        $hiradcs = Hiradc::paginate(10); // Mengambil 10 data per halaman

        return view('content.hiradc.index', compact('hiradcs'));
    }

    public function create()
    {
        return view('content.hiradc.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'identifikasi_lokasi' => 'required',
            'identifikasi_aktifitas' => 'required',
            'identifikasi_potensi_bahaya' => 'required',
            'identifikasi_dampak_bahaya' => 'required',
            'identifikasi_PIC' => 'required',
            'control_uraian' => 'required',
            'control_poin_kemungkinan' => 'required|integer',
            'control_poin_keparahan' => 'required|integer',
            'control_nilai_resiko' => 'nullable|integer',
            'recom_uraian' => 'required',
            'recom_poin_kemungkinan' => 'required|integer',
            'recom_poin_keparahan' => 'required|integer',
            'recom_nilai_resiko' => 'nullable|integer',
        ]);

        // Set default status to 'waiting'
        $validated['status'] = 'waiting';
        $validated['control_nilai_resiko'] = $request->input('control_poin_kemungkinan', null) * $request->input('control_poin_keparahan', null);
        $validated['recom_nilai_resiko'] = $request->input('recom_poin_kemungkinan', null) * $request->input('recom_poin_keparahan', null);
        $validated['created_at'] = now();
        $validated['updated_at'] = now();

        // Create the Hiradc record
        $create = Hiradc::create($validated);

        if (!$create) {
            return redirect()->back()->with('error', 'Data gagal ditambahkan');
        }

        return redirect()->route('hiradc.index')->with('success', 'Data berhasil ditambahkan');
    }

    public function show(Hiradc $hiradc)
    {
        return view('content.hiradc.show', compact('hiradc'));
    }

    public function edit(Hiradc $hiradc)
    {
        return view('content.hiradc.edit', compact('hiradc'));
    }

    public function update(Request $request, Hiradc $hiradc)
    {
        $validated = $request->validate([
            'identifikasi_lokasi' => 'required',
            'identifikasi_aktifitas' => 'required',
            'identifikasi_potensi_bahaya' => 'required',
            'identifikasi_dampak_bahaya' => 'required',
            'identifikasi_PIC' => 'required',
            'control_uraian' => 'required',
            'control_poin_kemungkinan' => 'required|integer',
            'control_poin_keparahan' => 'required|integer',
            'control_nilai_resiko' => 'nullable|integer',
            'recom_uraian' => 'required',
            'recom_poin_kemungkinan' => 'required|integer',
            'recom_poin_keparahan' => 'required|integer',
            'recom_nilai_resiko' => 'nullable|integer',
        ]);

        // Calculate risk values
        $validated['control_nilai_resiko'] = $request->input('control_poin_kemungkinan', null) * $request->input('control_poin_keparahan', null);
        $validated['recom_nilai_resiko'] = $request->input('recom_poin_kemungkinan', null) * $request->input('recom_poin_keparahan', null);
        $validated['updated_at'] = now();

        $hiradc->update($validated);
        return redirect()->route('hiradc.index')->with('success', 'Data berhasil diupdate');
    }

    public function destroy(Hiradc $hiradc)
    {
        $hiradc->delete();
        return redirect()->route('hiradc.index')->with('success', 'Data berhasil dihapus');
    }

    public function verify(Hiradc $hiradc)
    {
        $hiradc->status = 'verified';
        $hiradc->save();

        return redirect()->route('hiradc.index')->with('success', 'Data berhasil diverifikasi');
    }

    public function reject(Hiradc $hiradc)
    {
        $hiradc->status = 'unverified';
        $hiradc->save();

        return redirect()->route('hiradc.index')->with('success', 'Data berhasil ditolak');
    }

    public function exportPDF($id)
    {
        $data = Hiradc::findOrFail($id);

        $pdf = Pdf::loadView('content.hiradc.detail_pdf', compact('data'))->setPaper('a4', 'portrait');

        return $pdf->stream();
    }
}
