<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\OPD;

class OPDController extends Controller
{
    public function index()
    {
        $opd = OPD::all();
        return view('admin_sistem.opd.index', compact('opd'));
    }

    public function create()
    {
        return view('admin_sistem.opd.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'id_opd' => 'required|unique:opd,id_opd',
            'kode_opd' => 'required|unique:opd,kode_opd',
            'nama_opd' => 'required',
        ]);

        OPD::create($request->all());
        return redirect()->route('opd.index')->with('success', 'OPD berhasil ditambahkan');
    }

    public function show($id)
    {
        $opd = OPD::findOrFail($id);
        return view('admin_sistem.opd.show', compact('opd'));
    }

    public function edit($id)
    {
        $opd = OPD::findOrFail($id);
        return view('admin_sistem.opd.edit', compact('opd'));
    }

    public function update(Request $request, $id)
    {
        $opd = OPD::findOrFail($id);

        $request->validate([
            'kode_opd' => 'required|unique:opd,kode_opd,' . $id . ',id_opd',
            'nama_opd' => 'required',
        ]);

        $opd->update($request->all());
        return redirect()->route('opd.index')->with('success', 'OPD berhasil diupdate');
    }

    public function destroy($id)
    {
        $opd = OPD::findOrFail($id);
        $opd->delete();
        return redirect()->route('opd.index')->with('success', 'OPD berhasil dihapus');
    }
}