<?php

namespace App\Http\Controllers;

use App\Models\SK;
use App\Models\Usulan;
use App\Models\RiwayatUsulan;
use App\Models\LogIntegrasi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SKController extends Controller
{
    // ================= KELOLA SK (AKTIF) =================
    
    // Menampilkan daftar SK (aktif)
    public function index()
    {
        $sk = SK::with('usulan.pegawai')->where('status', 'aktif')->latest()->get();
        return view('admin_administrasi.sk.index', compact('sk'));
    }

    // Form tambah SK
    public function create()
    {
        $usulan = Usulan::where('status', 'sk_diterbitkan')->get();
        return view('admin_administrasi.sk.create', compact('usulan'));
    }

    // Simpan SK
    public function store(Request $request)
    {
        $request->validate([
            'id_usulan' => 'required|exists:usulan,id',
            'nomor_sk' => 'required|string|max:100',
            'tanggal_sk' => 'required|date',
            'file_sk' => 'required|file|mimes:pdf|max:2048',
            'keterangan' => 'nullable|string',
        ]);

        $file = $request->file('file_sk');
        $filename = 'SK_' . date('YmdHis') . '_' . $file->getClientOriginalName();
        $path = $file->storeAs('uploads/sk', $filename, 'public');

        SK::create([
            'id_usulan' => $request->id_usulan,
            'nomor_sk' => $request->nomor_sk,
            'tanggal_sk' => $request->tanggal_sk,
            'file_sk' => $path,
            'keterangan' => $request->keterangan,
        ]);

        return redirect()->route('sk.index')->with('success', 'SK berhasil ditambahkan');
    }

    // Form edit SK
    public function edit($id)
    {
        $sk = SK::findOrFail($id);
        $usulan = Usulan::where('status', 'sk_diterbitkan')->get();
        return view('admin_administrasi.sk.edit', compact('sk', 'usulan'));
    }

    // Update SK
    public function update(Request $request, $id)
    {
        $sk = SK::findOrFail($id);

        $request->validate([
            'id_usulan' => 'required|exists:usulan,id',
            'nomor_sk' => 'required|string|max:100',
            'tanggal_sk' => 'required|date',
            'file_sk' => 'nullable|file|mimes:pdf|max:2048',
            'keterangan' => 'nullable|string',
        ]);

        if ($request->hasFile('file_sk')) {
            Storage::disk('public')->delete($sk->file_sk);
            $file = $request->file('file_sk');
            $filename = 'SK_' . date('YmdHis') . '_' . $file->getClientOriginalName();
            $path = $file->storeAs('uploads/sk', $filename, 'public');
            $sk->file_sk = $path;
        }

        $sk->update([
            'id_usulan' => $request->id_usulan,
            'nomor_sk' => $request->nomor_sk,
            'tanggal_sk' => $request->tanggal_sk,
            'keterangan' => $request->keterangan,
        ]);

        return redirect()->route('sk.index')->with('success', 'SK berhasil diupdate');
    }

    // Hapus SK
    public function destroy($id)
    {
        $sk = SK::findOrFail($id);
        Storage::disk('public')->delete($sk->file_sk);
        $sk->delete();

        return redirect()->route('sk.index')->with('success', 'SK berhasil dihapus');
    }

    // Pindahkan ke arsip
    public function arsipkan($id)
    {
        $sk = SK::findOrFail($id);
        $sk->update(['status' => 'arsip']);

        return redirect()->route('sk.index')->with('success', 'SK dipindahkan ke arsip');
    }

    // Tampilkan arsip SK
    public function arsip()
    {
        $sk = SK::with('usulan.pegawai')->where('status', 'arsip')->latest()->get();
        return view('admin_administrasi.sk.arsip', compact('sk'));
    }

    // Kembalikan dari arsip ke aktif
    public function aktifkan($id)
    {
        $sk = SK::findOrFail($id);
        $sk->update(['status' => 'aktif']);

        return redirect()->route('sk.arsip')->with('success', 'SK dikembalikan ke aktif');
    }

    // Download file SK
    public function download($id)
    {
        $sk = SK::findOrFail($id);
        return response()->download(storage_path('app/public/' . $sk->file_sk));
    }

    // ================= KIRIM KE SISTEM EKSTERNAL (I-MUTASI & BKN) =================
    public function kirimKeSistem(Request $request, $id)
    {
        $sk = SK::findOrFail($id);
        $sistemTarget = $request->sistem_target ?? 'I-MUTASI';
        
        $userId = session('user')->id ?? 1;
        $username = session('user')->username ?? 'Sistem';

        LogIntegrasi::create([
            'id_usulan' => $sk->id_usulan,
            'id_sk' => $sk->id,
            'aksi' => 'kirim_ke_' . strtolower($sistemTarget),
            'status' => 'berhasil',
            'response' => 'Data berhasil dikirim ke ' . $sistemTarget . ' pada ' . date('d-m-Y H:i:s') . ' oleh ' . $username,
            'id_user' => $userId,
        ]);

        return back()->with('success', 'Data berhasil dikirim ke ' . $sistemTarget . ' (simulasi)');
    }

    // ================= LOG INTEGRASI =================
    public function logIntegrasi()
    {
        $log = LogIntegrasi::with('usulan.pegawai', 'sk', 'user')
                ->orderBy('created_at', 'desc')
                ->get();
        return view('admin_administrasi.log_integrasi.index', compact('log'));
    }

    // ================= RIWAYAT USULAN =================
    public function riwayatUsulan()
    {
        $riwayat = RiwayatUsulan::with('usulan.pegawai', 'user')
                    ->orderBy('created_at', 'desc')
                    ->get();
        return view('admin_administrasi.riwayat.index', compact('riwayat'));
    }
}