<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Usulan;
use App\Models\BahanRapat;
use Illuminate\Support\Facades\Storage;

class VerifikasiController extends Controller
{
    // Menampilkan daftar usulan yang perlu diverifikasi
    public function index()
    {
        $usulan = Usulan::with(['pegawai', 'opd'])
                        ->whereIn('status', ['menunggu_verifikasi_berkas', 'menunggu_verifikasi_substansi', 'revisi_berkas', 'ditolak'])
                        ->whereNotIn('status', ['disetujui', 'dibatalkan']) // Opsional, hanya yang belum selesai
                        ->orderBy('created_at', 'asc')
                        ->get();
        return view('verifikator.usulan.index', compact('usulan'));
    }

    // Menampilkan detail usulan untuk diverifikasi
    public function show($id)
    {
        $usulan = Usulan::with(['pegawai', 'opd', 'berkas'])->findOrFail($id);
        return view('verifikator.usulan.show', compact('usulan'));
    }

    public function verifikasiBerkas(Request $request, $id)
    {
        $usulan = Usulan::findOrFail($id);
        
        $request->validate([
            'status_berkas' => 'required|in:valid,perlu_revisi',
            'catatan' => 'required_if:status_berkas,perlu_revisi',
        ]);
        
        if ($request->status_berkas == 'valid') {
            $usulan->update([
                'status_berkas' => 'valid',
                'status' => 'menunggu_verifikasi_substansi',
                'catatan_verifikator' => $request->catatan,
            ]);
            return redirect()->route('verifikasi.index')->with('success', 'Berkas valid. Usulan lanjut ke verifikasi substansi.');
        } else {
            $usulan->update([
                'status_berkas' => 'perlu_revisi',
                'status' => 'revisi_berkas',
                'alasan_penolakan' => $request->catatan,
            ]);
            return redirect()->route('verifikasi.index')->with('success', 'Usulan dikembalikan ke OPD untuk revisi berkas.');
        }
    }
    
    public function verifikasiSubstansi(Request $request, $id)
    {
        $usulan = Usulan::findOrFail($id);
        
        $request->validate([
            'keputusan' => 'required|in:disetujui,ditolak,dibatalkan',
            'alasan' => 'required_if:keputusan,ditolak,dibatalkan',
        ]);
        
        if ($request->keputusan == 'disetujui') {
            $usulan->update([
                'status' => 'disetujui',
                'catatan_verifikator' => $request->alasan,
            ]);
            
            // Buat Bahan Rapat otomatis
            $this->buatBahanRapat($usulan);
            
            return redirect()->route('verifikasi.index')->with('success', 'Usulan disetujui dan bahan rapat telah dibuat otomatis.');
        } elseif ($request->keputusan == 'dibatalkan') {
            $usulan->update([
                'status' => 'dibatalkan',
                'alasan_pembatalan' => $request->alasan,
                'tanggal_pembatalan' => \Carbon\Carbon::now()->toDateString()
            ]);
            return redirect()->route('verifikasi.index')->with('success', 'Usulan dibatalkan karena kondisi khusus.');
        } else {
            $usulan->update([
                'status' => 'ditolak',
                'alasan_penolakan' => $request->alasan,
            ]);
            return redirect()->route('verifikasi.index')->with('success', 'Usulan ditolak.');
        }
    }
    
    // Membuat Bahan Rapat otomatis (Mengambil data dari DATABASE)
    private function buatBahanRapat($usulan)
    {
        $pegawai = $usulan->pegawai;
        $opd = $usulan->opd;
        
        // Generate nomor bahan rapat
        $tahun = date('Y');
        $bulan = date('m');
        $lastId = BahanRapat::max('id') + 1;
        $nomorBahan = 'BHP/' . $tahun . '/' . $bulan . '/' . str_pad($lastId, 3, '0', STR_PAD_LEFT);
        
        // Ambil data dari DATABASE
        $noSertifikat = $pegawai->no_sertifikat ?? 'REG-XXXXXXXX';
        $masaBerlaku = $pegawai->masa_berlaku_sertifikat 
            ? date('d-m-Y', strtotime($pegawai->masa_berlaku_sertifikat)) 
            : '08 Oktober ' . ($tahun + 1);
        $tahunPredikat = $pegawai->tahun_predikat_kinerja ?? ($tahun - 1);
        $noSuratPanrb = $usulan->no_surat_panrb ?? '___________________';
        
        // Generate kajian otomatis untuk Kenaikan Jabatan
        if ($usulan->jenis_usulan == 'kenaikan') {
            $kajian = "Berdasarkan Sertifikat Uji Kompetensi Kementerian Pendidikan ";
            $kajian .= "No." . $noSertifikat . " Saudara/i " . ($pegawai->nama_lengkap ?? '-') . " ";
            $kajian .= "NIP. " . ($pegawai->nip ?? $usulan->nip) . " telah mengikuti Uji Kompetensi Kenaikan ";
            $kajian .= "Jabatan Fungsional " . $usulan->jabatan_lama . " sebagai ";
            $kajian .= $usulan->jabatan_baru . " dan dinyatakan lulus serta memenuhi syarat ";
            $kajian .= "untuk pengajuan Kenaikan Jabatan dengan masa berlaku sampai " . $masaBerlaku . ";\n\n";
            $kajian .= "➢ Predikat Kinerja tahun " . $tahunPredikat . " bernilai 'BAIK';\n";
            $kajian .= "➢ Penetapan Angka Kredit " . number_format($usulan->angka_kredit_usulan ?? 0, 3, ',', '.') . ";\n";
            $kajian .= "➢ Pada saat mengajukan Kenaikan Jabatan yang bersangkutan berusia ";
            $kajian .= ($pegawai->usia_tahun ?? 0) . " tahun " . ($pegawai->usia_bulan ?? 0) . " bulan;\n";
            $kajian .= "➢ Memperhatikan Surat Menteri PANRB tanggal 10 Oktober " . $tahun . " ";
            $kajian .= "Nomor " . $noSuratPanrb . " serta besetting JF pada OPD terkait.";
        } else {
            // Kajian untuk Perpindahan atau Pemberhentian
            $kajian = "Usulan " . ($usulan->jenis_usulan == 'perpindahan' ? 'perpindahan' : 'pemberhentian') . " ";
            $kajian .= "untuk Saudara/i " . ($pegawai->nama_lengkap ?? '-') . " ";
            $kajian .= "NIP. " . ($pegawai->nip ?? $usulan->nip) . " ";
            
            if ($usulan->jenis_usulan == 'perpindahan') {
                $kajian .= "dari " . $usulan->unit_kerja_lama . " ke " . $usulan->unit_kerja_tujuan . " ";
                $kajian .= "dengan alasan " . $usulan->alasan_perpindahan . ".";
            } else {
                $kajian .= "dengan alasan " . $usulan->alasan_pemberhentian . " ";
                $kajian .= "dan tanggal efektif " . date('d-m-Y', strtotime($usulan->tanggal_efektif)) . ".";
            }
        }
        
        // Simpan bahan rapat (TANPA id_usulan - biarkan NULL)
        $bahanRapat = BahanRapat::create([
            'nomor_bahan' => $nomorBahan,
            'tanggal_bahan' => date('Y-m-d'),
            'no_urut' => 1,
            'kajian_otomatis' => $kajian,
            'tabel_besetting' => null,
            'status_bahan' => 'menunggu_persetujuan',
        ]);
        
        // Hubungkan usulan ke bahan rapat (many-to-many)
        $bahanRapat->usulan()->attach($usulan->id);
    }
}