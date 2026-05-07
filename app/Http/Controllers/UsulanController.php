<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Usulan;
use App\Models\Pegawai;
use App\Models\OPD;
use App\Models\RiwayatUsulan;
use Illuminate\Support\Facades\Storage;

class UsulanController extends Controller
{
    public function index()
    {
        $user = session('user');
        $usulan = Usulan::where('id_opd_pengusul', $user->id_opd)
                       ->with('pegawai')
                       ->orderBy('created_at', 'desc')
                       ->get();
        return view('admin_opd.usulan.index', compact('usulan'));
    }

    public function create()
    {
        $user = session('user');
        $pegawai = Pegawai::where('id_opd', $user->id_opd)->get();
        return view('admin_opd.usulan.create', compact('pegawai'));
    }

    public function store(Request $request)
    {
        $user = session('user');
        
        $request->validate([
            'nip' => 'required|exists:pegawai,nip',
            'jenis_usulan' => 'required|in:promosi,mutasi,demosi,pemberhentian',
            'jabatan_baru' => 'required_if:jenis_usulan,promosi',
            'golongan_baru' => 'required_if:jenis_usulan,promosi',
            'unit_kerja_tujuan' => 'required_if:jenis_usulan,mutasi,demosi',
            'alasan_perpindahan' => 'required_if:jenis_usulan,mutasi,demosi',
            'alasan_pemberhentian' => 'required_if:jenis_usulan,pemberhentian',
            'tanggal_efektif' => 'required_if:jenis_usulan,pemberhentian',
            'nomor_surat' => 'required',
            'no_surat_panrb' => 'nullable|string|max:100',
            'jenis_surat' => 'required',
            'jumlah_bandel' => 'required|integer',
            'keterangan_surat' => 'required',
            'file_surat' => 'required|file|mimes:pdf|max:2048',
            'sk_cpns' => 'nullable|file|mimes:pdf|max:2048',
            'sk_pns' => 'nullable|file|mimes:pdf|max:2048',
            'sk_jabatan' => 'nullable|file|mimes:pdf|max:2048',
            'sertifikat_uk' => 'nullable|file|mimes:pdf|max:2048',
            'angka_kredit' => 'nullable|file|mimes:pdf|max:2048',
        ]);
        
        $pegawai = Pegawai::findOrFail($request->nip);
        
        $file = $request->file('file_surat');
        $filename = time() . '_' . $file->getClientOriginalName();
        $path = $file->storeAs('uploads/surat_usulan', $filename, 'public');
        
        $usulan = Usulan::create([
            'nip' => $request->nip,
            'id_opd_pengusul' => $user->id_opd,
            'id_user_pengusul' => $user->id,
            'jenis_usulan' => $request->jenis_usulan,
            'jabatan_lama' => $pegawai->jabatan_saat_ini,
            'golongan_lama' => $pegawai->golongan,
            'unit_kerja_lama' => $pegawai->unit_kerja,
            'jabatan_baru' => $request->jabatan_baru,
            'golongan_baru' => $request->golongan_baru,
            'unit_kerja_tujuan' => $request->unit_kerja_tujuan,
            'angka_kredit_usulan' => $request->angka_kredit_usulan,
            'alasan_perpindahan' => $request->alasan_perpindahan,
            'alasan_pemberhentian' => $request->alasan_pemberhentian,
            'tanggal_efektif' => $request->tanggal_efektif,
            'nomor_surat' => $request->nomor_surat,
            'no_surat_panrb' => $request->no_surat_panrb,
            'jenis_surat' => $request->jenis_surat,
            'jumlah_bandel' => $request->jumlah_bandel,
            'keterangan_surat' => $request->keterangan_surat,
            'file_surat_pengantar' => $path,
            'status' => 'menunggu_verifikasi_berkas',
            'status_berkas' => 'menunggu_verifikasi',
        ]);
        
        // Catat riwayat usulan
        RiwayatUsulan::create([
            'id_usulan' => $usulan->id,
            'status' => 'menunggu_verifikasi_berkas',
            'keterangan' => 'Usulan diajukan oleh ' . ($user->username ?? 'Admin OPD'),
            'id_user' => $user->id,
        ]);
        
        $jenis_berkas = ['sk_cpns', 'sk_pns', 'sk_jabatan', 'sertifikat_uk', 'angka_kredit'];
        
        foreach ($jenis_berkas as $jenis) {
            if ($request->hasFile($jenis)) {
                $file = $request->file($jenis);
                $filename = time() . '_' . $jenis . '.' . $file->getClientOriginalExtension();
                $path = $file->storeAs('uploads/berkas_usulan/' . $usulan->id, $filename, 'public');
                
                $usulan->berkas()->create([
                    'jenis_berkas' => $jenis,
                    'nama_file' => $filename,
                    'path_file' => $path,
                ]);
            }
        }
        
        return redirect()->route('usulan.index')->with('success', 'Usulan berhasil diajukan');
    }

    public function show($id)
    {
        $usulan = Usulan::with(['pegawai', 'berkas'])->findOrFail($id);
        return view('admin_opd.usulan.show', compact('usulan'));
    }

    public function edit($id)
    {
        $usulan = Usulan::findOrFail($id);
        $pegawai = Pegawai::all();
        return view('admin_opd.usulan.edit', compact('usulan', 'pegawai'));
    }

    public function update(Request $request, $id)
    {
        $user = session('user');
        $usulan = Usulan::findOrFail($id);
        
        if (!in_array($usulan->status, ['menunggu_verifikasi_berkas', 'revisi_berkas'])) {
            return redirect()->route('usulan.index')->with('error', 'Usulan tidak dapat diedit karena sudah diproses');
        }
        
        $request->validate([
            'jabatan_baru' => 'required_if:jenis_usulan,promosi',
            'golongan_baru' => 'required_if:jenis_usulan,promosi',
            'unit_kerja_tujuan' => 'required_if:jenis_usulan,mutasi,demosi',
            'alasan_perpindahan' => 'required_if:jenis_usulan,mutasi,demosi',
            'alasan_pemberhentian' => 'required_if:jenis_usulan,pemberhentian',
            'tanggal_efektif' => 'required_if:jenis_usulan,pemberhentian',
            'nomor_surat' => 'required',
            'no_surat_panrb' => 'nullable|string|max:100',
            'jenis_surat' => 'required',
            'jumlah_bandel' => 'required|integer',
            'keterangan_surat' => 'required',
            'file_surat' => 'nullable|file|mimes:pdf|max:2048',
        ]);
        
        $updateData = [
            'jabatan_baru' => $request->jabatan_baru,
            'golongan_baru' => $request->golongan_baru,
            'unit_kerja_tujuan' => $request->unit_kerja_tujuan,
            'angka_kredit_usulan' => $request->angka_kredit_usulan,
            'alasan_perpindahan' => $request->alasan_perpindahan,
            'alasan_pemberhentian' => $request->alasan_pemberhentian,
            'tanggal_efektif' => $request->tanggal_efektif,
            'nomor_surat' => $request->nomor_surat,
            'no_surat_panrb' => $request->no_surat_panrb,
            'jenis_surat' => $request->jenis_surat,
            'jumlah_bandel' => $request->jumlah_bandel,
            'keterangan_surat' => $request->keterangan_surat,
        ];
        
        if ($request->hasFile('file_surat')) {
            Storage::disk('public')->delete($usulan->file_surat_pengantar);
            $file = $request->file('file_surat');
            $filename = time() . '_' . $file->getClientOriginalName();
            $path = $file->storeAs('uploads/surat_usulan', $filename, 'public');
            $updateData['file_surat_pengantar'] = $path;
        }
        
        if ($usulan->status == 'revisi_berkas') {
            $updateData['status'] = 'menunggu_verifikasi_berkas';
            $updateData['status_berkas'] = 'setelah_revisi';
        }
        
        $usulan->update($updateData);
        
        $jenis_berkas = ['sk_cpns', 'sk_pns', 'sk_jabatan', 'sertifikat_uk', 'angka_kredit'];
        
        foreach ($jenis_berkas as $jenis) {
            if ($request->hasFile($jenis)) {
                $oldBerkas = $usulan->berkas()->where('jenis_berkas', $jenis)->first();
                if ($oldBerkas) {
                    Storage::disk('public')->delete($oldBerkas->path_file);
                    $oldBerkas->delete();
                }
                
                $file = $request->file($jenis);
                $filename = time() . '_' . $jenis . '.' . $file->getClientOriginalExtension();
                $path = $file->storeAs('uploads/berkas_usulan/' . $usulan->id, $filename, 'public');
                
                $usulan->berkas()->create([
                    'jenis_berkas' => $jenis,
                    'nama_file' => $filename,
                    'path_file' => $path,
                ]);
            }
        }
        
        return redirect()->route('usulan.index')->with('success', 'Usulan berhasil diupdate');
    }

    public function destroy($id)
    {
        $usulan = Usulan::findOrFail($id);
        
        if (!in_array($usulan->status, ['menunggu_verifikasi_berkas', 'revisi_berkas'])) {
            return redirect()->route('usulan.index')->with('error', 'Usulan tidak dapat dihapus karena sudah diproses');
        }
        
        Storage::disk('public')->delete($usulan->file_surat_pengantar);
        foreach ($usulan->berkas as $berkas) {
            Storage::disk('public')->delete($berkas->path_file);
        }
        
        $usulan->delete();
        
        return redirect()->route('usulan.index')->with('success', 'Usulan berhasil dihapus');
    }
}