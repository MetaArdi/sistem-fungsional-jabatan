<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\BesettingJF;
use App\Models\OPD;

class BesettingJFController extends Controller
{
    // MENAMPILKAN DAFTAR BESETTING JF
    public function index()
    {
        $besetting = BesettingJF::with('opd')->orderBy('tahun', 'desc')->get();
        return view('admin_sistem.besetting.index', compact('besetting'));
    }

    // MENAMPILKAN FORM TAMBAH BESETTING JF
    public function create()
    {
        $opd = OPD::all();
        return view('admin_sistem.besetting.create', compact('opd'));
    }

    // MENYIMPAN DATA BESETTING JF BARU
    public function store(Request $request)
    {
        $request->validate([
            'opd_id' => 'required|exists:opd,id_opd',
            'jabatan_fungsional' => 'required',
            'jenjang' => 'required',
            'kebutuhan' => 'required|integer',
            'ketersediaan' => 'required|integer',
            'tahun' => 'required|digits:4',
        ]);

        BesettingJF::create([
            'opd_id' => $request->opd_id,              // foreign key yang mengacu pada tabel opd (id_opd)
            'jabatan_fungsional' => $request->jabatan_fungsional,
            'jenjang' => $request->jenjang,
            'kebutuhan' => $request->kebutuhan,
            'ketersediaan' => $request->ketersediaan,
            'tahun' => $request->tahun,
        ]);

        return redirect()->route('besetting-jf.index')->with('success', 'Data Besetting JF berhasil ditambahkan');
    }

    // MENAMPILKAN DETAIL BESETTING JF
    public function show($id)
    {
        $besetting = BesettingJF::with('opd')->findOrFail($id);
        return view('admin_sistem.besetting.show', compact('besetting'));
    }

    // MENAMPILKAN FORM EDIT BESETTING JF
    public function edit($id)
    {
        $besetting = BesettingJF::findOrFail($id);
        $opd = OPD::all();
        return view('admin_sistem.besetting.edit', compact('besetting', 'opd'));
    }

    // MENGUPDATE DATA BESETTING JF
    public function update(Request $request, $id)
    {
        $besetting = BesettingJF::findOrFail($id);

        $request->validate([
            'opd_id' => 'required|exists:opd,id_opd',  // id_opd yang pertama milik besetting jf (foreign key yang mengacu pada tabel opd)
            'jabatan_fungsional' => 'required',
            'jenjang' => 'required',
            'kebutuhan' => 'required|integer',
            'ketersediaan' => 'required|integer',
            'tahun' => 'required|digits:4',
        ]);

        $besetting->update([
            'opd_id' => $request->opd_id,              // id_opd yang pertama milik besetting jf (foreign key yang mengacu pada tabel opd)
            'jabatan_fungsional' => $request->jabatan_fungsional,
            'jenjang' => $request->jenjang,
            'kebutuhan' => $request->kebutuhan,
            'ketersediaan' => $request->ketersediaan,
            'tahun' => $request->tahun,
        ]);

        return redirect()->route('besetting-jf.index')->with('success', 'Data Besetting JF berhasil diupdate');
    }

    // MENGHAPUS DATA BESETTING JF
    public function destroy($id)
    {
        $besetting = BesettingJF::findOrFail($id);
        $besetting->delete();
        return redirect()->route('besetting-jf.index')->with('success', 'Data Besetting JF berhasil dihapus');
    }
}