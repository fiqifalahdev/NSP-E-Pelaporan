<?php

namespace App\Http\Controllers;

use App\Models\SafetyPatrol;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Barryvdh\DomPDF\Facade\Pdf;

class SafetyPatrolController extends Controller
{
    public function index()
    {
        $safetyPatrols = SafetyPatrol::orderBy('tanggal', 'desc')->paginate(10);
        return view('content.safety-patrols.index', compact('safetyPatrols'));
    }

    public function create()
    {
        return view('content.safety-patrols.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'kriteria' => 'required|string|max:255',
            'lokasi' => 'required|string|max:255',
            'temuan' => 'required|in:Safe,Unsafe Action,Unsafe Condition',
            'tanggal' => 'required|date',
            'kesesuaian' => 'required|in:Baik,Buruk',
            'uraian' => 'nullable|string',
            'foto_temuan' => 'nullable|image|mimes:jpg,jpeg,png|max:5120', // validasi file
            'risiko' => 'nullable|string|max:255', // jika ada input risiko
            'tindak_lanjut' => 'nullable|string|max:255', // jika ada input tindak lanjut
        ]);

        $data = $request->only([
            'kriteria',
            'lokasi',
            'temuan',
            'tanggal',
            'kesesuaian',
            'uraian',
            'risiko',
            'tindak_lanjut',
        ]);

        if ($request->hasFile('foto_temuan')) {
            $file = $request->file('foto_temuan');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->storeAs('public/foto_temuan', $filename); // simpan ke storage/app/public/foto_temuan
            $data['foto_temuan'] = $filename;
        }

        SafetyPatrol::create($data);

        return redirect()->route('safety-patrol.index')->with('success', 'Data safety patrol berhasil ditambahkan.');
    }


    public function show(SafetyPatrol $safetyPatrol)
    {
        return view('content.safety-patrols.show', compact('safetyPatrol'));
    }

    public function edit(SafetyPatrol $safetyPatrol)
    {
        return view('content.safety-patrols.edit', compact('safetyPatrol'));
    }

    public function update(Request $request, SafetyPatrol $safetyPatrol)
    {
        try {
            $request->validate([
                'kriteria' => 'required|string|max:255',
                'lokasi' => 'required|string|max:255',
                'temuan' => 'required|in:Safe,Unsafe Action,Unsafe Condition',
                'tanggal' => 'required|date',
                'kesesuaian' => 'required|in:Baik,Buruk',
                'uraian' => 'nullable|string',
                'foto_temuan' => 'nullable|image|mimes:jpg,jpeg,png|max:2048', // validasi file
            ]);

            $data = $request->only([
                'kriteria',
                'lokasi',
                'temuan',
                'tanggal',
                'kesesuaian',
                'uraian',
                'risiko',
                'tindak_lanjut'
            ]);

            if ($request->hasFile('foto_temuan')) {
                // Hapus file lama jika ada
                if ($safetyPatrol->foto_temuan && Storage::exists('public/foto_temuan/' . $safetyPatrol->foto_temuan)) {
                    Storage::delete('public/foto_temuan/' . $safetyPatrol->foto_temuan);
                }

                $file = $request->file('foto_temuan');
                $filename = time() . '_' . $file->getClientOriginalName();
                $file->storeAs('public/foto_temuan', $filename);
                $data['foto_temuan'] = $filename;
            }

            $safetyPatrol->update($data);

            return redirect()->route('safety-patrol.index')->with('success', 'Data safety patrol berhasil diperbarui.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Gagal memperbarui data safety patrol: ' . $e->getMessage());
        }
    }


    public function destroy(SafetyPatrol $safetyPatrol)
    {
        $safetyPatrol->delete();

        return redirect()->route('safety-patrol.index')->with('success', 'Data safety patrol berhasil dihapus.');
    }


    public function exportPDF($id)
    {
        $data = SafetyPatrol::findOrFail($id);

        $pdf = Pdf::loadView('content.safety-patrols.detail_pdf', compact('data'))->setPaper('a4', 'portrait');

        return $pdf->stream();
    }

    public function verify(SafetyPatrol $safetyPatrol)
    {
        $safetyPatrol->status = 'verified';
        $safetyPatrol->save();

        return redirect()->route('safety-patrol.index')->with('success', 'Data berhasil diverifikasi');
    }

    public function reject(Request $request, SafetyPatrol $safetyPatrol)
    {
        $safetyPatrol->status = 'unverified';
        $safetyPatrol->note = $request->input('note');
        $safetyPatrol->save();

        return redirect()->route('safety-patrol.index')->with('success', 'Data berhasil ditolak');
    }
}
