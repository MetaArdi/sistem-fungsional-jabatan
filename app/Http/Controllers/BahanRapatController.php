<?php

namespace App\Http\Controllers;

use App\Models\Usulan;
use App\Models\Pegawai;
use App\Models\BesettingJF;
use App\Models\BahanRapat;
use App\Models\RiwayatUsulan;
use App\Helpers\WordGenerator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class BahanRapatController extends Controller
{
    // ================= VERIFIKATOR =================
    public function indexVerifikator()
    {
        $bahanRapat = BahanRapat::with('usulan.pegawai')
            ->latest()
            ->get();

        return view('verifikator.bahan_rapat.index', compact('bahanRapat'));
    }

    public function showVerifikator($id)
    {
        $bahanRapat = $this->getBahanRapat($id);
        $usulanList = $bahanRapat->usulan;
        return view('verifikator.bahan_rapat.show', compact('bahanRapat', 'usulanList'));
    }

    // ================= ADMIN ADMINISTRASI =================
    public function indexAdmin()
    {
        $bahanRapat = BahanRapat::with('usulan.pegawai')
            ->latest()
            ->get();

        return view('admin_administrasi.bahan_rapat.index', compact('bahanRapat'));
    }

    public function showAdmin($id)
    {
        $bahanRapat = $this->getBahanRapat($id);
        $usulanList = $bahanRapat->usulan;
        return view('admin_administrasi.bahan_rapat.show', compact('bahanRapat', 'usulanList'));
    }

    public function approve(Request $request, $id)
    {
        $bahanRapat = $this->getBahanRapat($id);

        $request->validate([
            'alasan' => 'nullable|string',
        ]);

        $bahanRapat->update([
            'status_bahan' => 'disetujui',
            'alasan_persetujuan' => $request->alasan,
            'disetujui_oleh' => session('user')->id ?? 1,
            'tanggal_disetujui' => now(),
        ]);

        // Update status SEMUA usulan yang terkait dengan bahan rapat ini
        foreach ($bahanRapat->usulan as $usulan) {
            $usulan->update([
                'status' => 'sk_diterbitkan'
            ]);
            
            // ================= CATAT RIWAYAT =================
            RiwayatUsulan::create([
                'id_usulan' => $usulan->id,
                'status' => 'sk_diterbitkan',
                'keterangan' => 'Bahan rapat disetujui oleh ' . (session('user')->username ?? 'Admin Administrasi'),
                'id_user' => session('user')->id ?? 1,
            ]);
        }

        return back()->with('success', 'Bahan rapat berhasil disetujui');
    }

    public function reject(Request $request, $id)
    {
        $bahanRapat = $this->getBahanRapat($id);

        $request->validate([
            'alasan' => 'required|string',
        ]);

        $bahanRapat->update([
            'status_bahan' => 'ditolak',
            'alasan_persetujuan' => $request->alasan,
            'disetujui_oleh' => session('user')->id ?? 1,
            'tanggal_disetujui' => now(),
        ]);

        // Update status SEMUA usulan yang terkait dengan bahan rapat ini
        foreach ($bahanRapat->usulan as $usulan) {
            $usulan->update([
                'status' => 'ditolak_administrasi',
                'alasan_penolakan' => $request->alasan,
            ]);
            
            // ================= CATAT RIWAYAT =================
            RiwayatUsulan::create([
                'id_usulan' => $usulan->id,
                'status' => 'ditolak_administrasi',
                'keterangan' => 'Bahan rapat ditolak oleh ' . (session('user')->username ?? 'Admin Administrasi') . ' dengan alasan: ' . $request->alasan,
                'id_user' => session('user')->id ?? 1,
            ]);
        }

        return back()->with('error', 'Bahan rapat ditolak');
    }

    // ================= UPDATE KAJIAN =================
    public function updateKajian(Request $request, $id)
    {
        $bahanRapat = $this->getBahanRapat($id);
        $bahanRapat->update(['kajian_otomatis' => $request->kajian_otomatis]);
        
        return back()->with('success', 'Kajian berhasil disimpan');
    }

    // ================= DOWNLOAD DRAFT =================
    public function downloadDraft($id)
    {
        $bahanRapat = $this->getBahanRapat($id);
        
        $usulanList = $bahanRapat->usulan;
        
        if ($usulanList->isEmpty()) {
            return back()->with('error', 'Tidak ada usulan dalam bahan rapat ini');
        }
        
        $pegawaiPertama = $usulanList->first()->pegawai;
        $besettingJf = BesettingJF::where('opd_id', $pegawaiPertama->id_opd ?? '')->get();
        
        $result = WordGenerator::generateMultiple($usulanList, $besettingJf, $bahanRapat, 'draft');
        
        if ($result && file_exists($result['path'])) {
            return response()->download($result['path'], $result['name'])->deleteFileAfterSend(true);
        }
        
        return back()->with('error', 'Gagal membuat draft');
    }

    // ================= DOWNLOAD FINAL =================
    public function downloadFinal($id)
    {
        $bahanRapat = $this->getBahanRapat($id);
        
        if ($bahanRapat->status_bahan !== 'disetujui') {
            return back()->with('error', 'Bahan rapat belum disetujui, tidak bisa download final');
        }
        
        $usulanList = $bahanRapat->usulan;
        
        if ($usulanList->isEmpty()) {
            return back()->with('error', 'Tidak ada usulan dalam bahan rapat ini');
        }
        
        $pegawaiPertama = $usulanList->first()->pegawai;
        $besettingJf = BesettingJF::where('opd_id', $pegawaiPertama->id_opd ?? '')->get();
        
        $result = WordGenerator::generateMultiple($usulanList, $besettingJf, $bahanRapat, 'final');
        
        if ($result && file_exists($result['path'])) {
            return response()->download($result['path'], $result['name'])->deleteFileAfterSend(true);
        }
        
        return back()->with('error', 'Gagal membuat file final');
    }

    // ================= CREATE BAHAN RAPAT (Untuk Multiple Usulan) =================
    public function create()
    {
        $usulan = Usulan::whereIn('status', ['menunggu_persetujuan', 'sedang_diverifikasi'])
                        ->with('pegawai')
                        ->get();
        return view('verifikator.bahan_rapat.create', compact('usulan'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'id_usulan' => 'required|array|min:1',
            'id_usulan.*' => 'exists:usulan,id',
            'nomor_bahan' => 'required|string|unique:bahan_rapat,nomor_bahan',
            'tanggal_bahan' => 'required|date',
        ]);

        $bahanRapat = BahanRapat::create([
            'nomor_bahan' => $request->nomor_bahan,
            'tanggal_bahan' => $request->tanggal_bahan,
            'no_urut' => 1,
            'status_bahan' => 'menunggu_persetujuan',
        ]);

        $bahanRapat->usulan()->attach($request->id_usulan);
        
        // Catat riwayat untuk setiap usulan yang di-attach
        foreach ($request->id_usulan as $id_usulan) {
            RiwayatUsulan::create([
                'id_usulan' => $id_usulan,
                'status' => 'menunggu_persetujuan',
                'keterangan' => 'Bahan rapat telah dibuat oleh ' . (session('user')->username ?? 'Verifikator'),
                'id_user' => session('user')->id ?? 1,
            ]);
        }

        return redirect()->route('bahan_rapat.verifikator.index')
            ->with('success', 'Bahan rapat berhasil dibuat dengan ' . count($request->id_usulan) . ' usulan');
    }

    // ================= HELPER =================
    private function getBahanRapat($id)
    {
        return BahanRapat::with('usulan.pegawai')->findOrFail($id);
    }
}