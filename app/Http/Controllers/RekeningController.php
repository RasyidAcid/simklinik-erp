<?php
namespace App\Http\Controllers;

use App\Models\Rekening;
use Illuminate\Http\Request;
use Inertia\Inertia;

class RekeningController extends Controller
{
    public function index()
    {
        return Inertia::render('Rekening/Index', [
            'data' => Rekening::latest()->get()
        ]);
    }

    public function create()
    {
        return Inertia::render('Rekening/Create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'kode_rekening' => 'required|unique:rekenings,kode_rekening',
            'nama_rekening' => 'required'
        ]);

        Rekening::create($request->all());

        return redirect()->route('rekening.index')
            ->with('success', 'Data berhasil disimpan');
    }

    public function edit(Rekening $rekening)
    {
        return Inertia::render('Rekening/Edit', [
            'data' => $rekening
        ]);
    }

    public function update(Request $request, Rekening $rekening)
    {
        $request->validate([
            'kode_rekening' => 'required|unique:rekenings,kode_rekening,' . $rekening->id,
            'nama_rekening' => 'required'
        ]);

        $rekening->update($request->all());

        return redirect()->route('rekening.index')
            ->with('success', 'Data berhasil diupdate');
    }

    public function destroy(Rekening $rekening)
    {
        $rekening->delete();

        return back()->with('success', 'Data berhasil dihapus');
    }
}