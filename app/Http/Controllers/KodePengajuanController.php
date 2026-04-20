<?php

namespace App\Http\Controllers;

use App\Models\KodePengajuan;
use Illuminate\Http\Request;
use Inertia\Inertia;

class KodePengajuanController extends Controller
{
    public function index()
    {
        return Inertia::render('KodePengajuan/Index', [
            'data' => KodePengajuan::latest()->get()
        ]);
    }

    public function create()
    {
        return Inertia::render('KodePengajuan/Create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'pj_code' => 'required',
            'pj_name' => 'required',
        ]);

        KodePengajuan::create([
            ...$request->all(),
            'update_ip' => $request->ip()
        ]);

        return redirect()->route('kode-pengajuan.index');
    }

    public function edit(KodePengajuan $kodePengajuan)
    {
        return Inertia::render('KodePengajuan/Edit', [
            'data' => $kodePengajuan
        ]);
    }

    public function update(Request $request, KodePengajuan $kodePengajuan)
    {
        $kodePengajuan->update([
            ...$request->all(),
            'update_ip' => $request->ip()
        ]);

        return redirect()->route('kode-pengajuan.index');
    }

    public function destroy(KodePengajuan $kodePengajuan)
    {
        $kodePengajuan->delete();
        return back();
    }
}
