<?php

namespace App\Http\Controllers;

use App\Models\ToolboxMeeting;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;

class ToolboxMeetingController extends Controller
{
    public function index()
    {
        $meetings = ToolboxMeeting::latest()->paginate(10);
        return view('content.toolbox_meetings.index', compact('meetings'));
    }

    public function create()
    {
        return view('content.toolbox_meetings.create');
    }

    public function store(Request $request)
    {
        try {
            $validated = $request->validate([
                'tanggal' => 'required|date',
                'uraian_aktivitas' => 'nullable|string',
                'penanggung_jawab' => 'nullable|string',
                'keterangan' => 'nullable|string',
                'kehadiran' => 'nullable|array',
                'kehadiran.*' => 'string',
                'jabatan' => 'nullable|string',
            ]);

            ToolboxMeeting::create($validated);

            return redirect()->route('toolbox-meetings.index')->with('success', 'Laporan Toolbox Meeting berhasil ditambahkan.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Gagal menambahkan laporan: ' . $e->getMessage());
        }
    }

    public function show(ToolboxMeeting $toolboxMeeting)
    {
        return view('content.toolbox_meetings.show', compact('toolboxMeeting'));
    }

    public function edit(ToolboxMeeting $toolboxMeeting)
    {
        return view('content.toolbox_meetings.edit', compact('toolboxMeeting'));
    }

    public function update(Request $request, ToolboxMeeting $toolboxMeeting)
    {
        $validated = $request->validate([
            'tanggal' => 'required|date',
            'uraian_aktivitas' => 'nullable|string',
            'penanggung_jawab' => 'nullable|string',
            'keterangan' => 'nullable|string',
            'kehadiran' => 'nullable|array',
            'kehadiran.*' => 'string',
            'jabatan' => 'nullable|string',
        ]);

        $toolboxMeeting->update($validated);

        return redirect()->route('toolbox-meetings.index')->with('success', 'Laporan berhasil diperbarui.');
    }

    public function destroy(ToolboxMeeting $toolboxMeeting)
    {
        $toolboxMeeting->delete();

        return redirect()->route('toolbox-meetings.index')->with('success', 'Laporan berhasil dihapus.');
    }

    public function changeStatus(ToolboxMeeting $toolboxMeeting)
    {
        $toolboxMeeting->update(['status' => 'closed']);

        return redirect()->route('toolbox-meetings.index')->with('success', 'Status laporan berhasil diubah.');
    }

    public function verify(ToolboxMeeting $toolboxMeeting)
    {
        $toolboxMeeting->status = 'verified';
        $toolboxMeeting->save();

        return redirect()->route('toolbox-meetings.index')->with('success', 'Data berhasil diverifikasi');
    }

    public function reject(Request $request, ToolboxMeeting $toolboxMeeting)
    {
        $toolboxMeeting->status = 'unverified';
        $toolboxMeeting->note = $request->input('note');
        $toolboxMeeting->save();

        return redirect()->route('toolbox-meetings.index')->with('success', 'Data berhasil ditolak');
    }

    public function exportPDF($id)
    {
        $data = ToolboxMeeting::findOrFail($id);

        $pdf = Pdf::loadView('content.toolbox_meetings.detail_pdf', compact('data'))->setPaper('a4', 'portrait');

        return $pdf->stream();
    }
}
