<?php
namespace App\Http\Controllers;

use App\Models\Pengajuan;
use App\Models\PengajuanDetail;
use Illuminate\Http\Request;
use Inertia\Inertia;

class PengajuanController extends Controller
{
    public function index()
    {
        return Inertia::render('Pengajuan/Index', [
            'data' => Pengajuan::latest()->get()
        ]);
    }

    public function create()
    {
        return Inertia::render('Pengajuan/Create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'kas_bukti_no' => 'required',
            'kas_bukti_date' => 'required',
        ]);

        // HEADER
        $header = Pengajuan::create([
            'kas_bukti_no' => $request->kas_bukti_no,
            'kas_bukti_date' => $request->kas_bukti_date,
            'pj_code' => $request->pj_code,
            'kas_keperluan' => $request->kas_keperluan,
            'kas_notes' => $request->kas_notes,
            'user_login' => auth()->user()->name,
            'update_ip' => $request->ip(),
        ]);

        // DETAIL
        foreach ($request->details as $d) {
            PengajuanDetail::create([
                'kas_bukti_no' => $header->kas_bukti_no,
                'bar_name' => $d['bar_name'],
                'kas_jumlah' => $d['kas_jumlah'],
                'kas_nilai' => $d['kas_nilai'],
                'kas_total' => $d['kas_jumlah'] * $d['kas_nilai'],
            ]);
        }

        return redirect()->route('pengajuan.index')
            ->with('success', 'Data pengajuan berhasil disimpan');
    }

    public function edit($id)
    {
        $pengajuan = \App\Models\Pengajuan::with('details')->findOrFail($id);

        return Inertia::render('Pengajuan/Edit', [
            'data' => $pengajuan
        ]);
    }

    public function update(Request $request, $id)
    {
        $pengajuan = \App\Models\Pengajuan::findOrFail($id);

        $pengajuan->update([
            'kas_bukti_no' => $request->kas_bukti_no,
            'kas_bukti_date' => $request->kas_bukti_date,
            'pj_code' => $request->pj_code,
            'kas_keperluan' => $request->kas_keperluan,
            'kas_notes' => $request->kas_notes,
        ]);

        // hapus detail lama
        $pengajuan->details()->delete();

        // insert ulang
        foreach ($request->details as $d) {
            $pengajuan->details()->create($d);
        }

        return redirect()->route('pengajuan.index')
            ->with('success', 'Data berhasil diupdate');
    }

    public function destroy(Pengajuan $pengajuan)
    {
        $pengajuan->delete();
        return back();
    }
}