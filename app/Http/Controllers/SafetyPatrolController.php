<?php

namespace App\Http\Controllers;

use App\Models\SafetyPatrol;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
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
            'inspector' => 'nullable|string|max:255',
            'klasifikasi_temuan' => 'nullable|string|max:255',
            'kriteria' => 'nullable|string|max:255',
            'lokasi' => 'required|string|max:255',
            'risiko' => 'nullable|string|max:255', // jika ada input risiko
            'tanggal' => 'required|date',
            'tindak_lanjut' => 'nullable|string|max:255',
            'foto_temuan' => 'nullable|image|mimes:jpg,jpeg,png|max:5120',
            'foto_tindak_lanjut' => 'nullable|image|mimes:jpg,jpeg,png|max:5120',
        ]);

        $data = $request->only([
            'inspector',
            'klasifikasi_temuan',
            'kriteria',
            'lokasi',
            'tanggal',
            'tindak_lanjut',
            'risiko',
        ]);

        if ($request->hasFile('foto_temuan')) {
            $file = $request->file('foto_temuan');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->storeAs('public/foto_temuan', $filename);
            $data['foto_temuan'] = $filename;
        }

        if ($request->hasFile('foto_tindak_lanjut')) {
            $file = $request->file('foto_tindak_lanjut');
            $filename = time() . '_tindak_lanjut_' . $file->getClientOriginalName();
            $file->storeAs('public/foto_tindak_lanjut', $filename);
            $data['foto_tindak_lanjut'] = $filename;
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
                'inspector' => 'nullable|string|max:255',
                'klasifikasi_temuan' => 'nullable|string|max:255',
                'kriteria' => 'nullable|string|max:255',
                'lokasi' => 'required|string|max:255',
                'risiko' => 'nullable|string|max:255', // jika ada input risiko
                'tanggal' => 'required|date',
                'tindak_lanjut' => 'nullable|string|max:255',
                'foto_temuan' => 'nullable|image|mimes:jpg,jpeg,png|max:5120',
                'foto_tindak_lanjut' => 'nullable|image|mimes:jpg,jpeg,png|max:5120',
            ]);

            $data = $request->only([
                'inspector',
                'klasifikasi_temuan',
                'kriteria',
                'lokasi',
                'tanggal',
                'tindak_lanjut',
                'risiko',
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

            if ($request->hasFile('foto_tindak_lanjut')) {
                // Hapus file lama jika ada
                if ($safetyPatrol->foto_tindak_lanjut && Storage::exists('public/foto_tindak_lanjut/' . $safetyPatrol->foto_tindak_lanjut)) {
                    Storage::delete('public/foto_tindak_lanjut/' . $safetyPatrol->foto_tindak_lanjut);
                }

                $file = $request->file('foto_tindak_lanjut');
                $filename = time() . '_tindak_lanjut_' . $file->getClientOriginalName();
                $file->storeAs('public/foto_tindak_lanjut', $filename);
                $data['foto_tindak_lanjut'] = $filename;
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
