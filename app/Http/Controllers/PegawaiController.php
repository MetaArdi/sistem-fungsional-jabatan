<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pegawai;
use App\Models\OPD;
use App\Models\Usulan;
use Carbon\Carbon;

class PegawaiController extends Controller
{
    public function index()
    {
        $user = session('user');
        
        if (!$user || $user->role != 'admin_opd') {
            return redirect('/')->with('error', 'Akses ditolak');
        }
        
        $pegawai = Pegawai::where('id_opd', $user->id_opd)->get();
        return view('admin_opd.pegawai.index', compact('pegawai'));
    }

    public function create()
    {
        $user = session('user');
        
        if (!$user || $user->role != 'admin_opd') {
            return redirect('/')->with('error', 'Akses ditolak');
        }
        
        return view('admin_opd.pegawai.create');
    }

    public function store(Request $request)
    {
        $user = session('user');
        
        if (!$user || $user->role != 'admin_opd') {
            return redirect('/')->with('error', 'Akses ditolak');
        }
        
        // CEK: Pastikan id_opd tidak null
        if (empty($user->id_opd)) {
            return redirect()->back()->with('error', 'User tidak memiliki ID OPD. Silakan login ulang atau hubungi Admin.')->withInput();
        }
        
        $request->validate([
            'nip' => 'required|unique:pegawai,nip',
            'nama_lengkap' => 'required',
            'tempat_lahir' => 'required',
            'tanggal_lahir' => 'required|date',
            'jenis_kelamin' => 'required',
            'agama' => 'required',
            'status_perkawinan' => 'required',
            'alamat' => 'required',
            'no_hp' => 'required',
            'email' => 'required|email',
            'pangkat' => 'required',
            'golongan' => 'required',
            'tmt_pangkat' => 'required|date',
            'jabatan_saat_ini' => 'required',
            'unit_kerja' => 'required',
            'angka_kredit' => 'required|numeric',
            'usia_tahun' => 'required|integer',
            'usia_bulan' => 'required|integer',
            'pendidikan_terakhir' => 'required',
            'jurusan' => 'required',
            'tahun_lulus' => 'required|digits:4',
            'no_sertifikat' => 'nullable|string|max:100',
            'masa_berlaku_sertifikat' => 'nullable|date',
            'tahun_predikat_kinerja' => 'nullable|integer|min:2000|max:' . date('Y'),
        ]);

        try {
            Pegawai::create([
                'nip' => $request->nip,
                'no_sertifikat' => $request->no_sertifikat,
                'masa_berlaku_sertifikat' => $request->masa_berlaku_sertifikat,
                'tahun_predikat_kinerja' => $request->tahun_predikat_kinerja,
                'nama_lengkap' => $request->nama_lengkap,
                'tempat_lahir' => $request->tempat_lahir,
                'tanggal_lahir' => $request->tanggal_lahir,
                'jenis_kelamin' => $request->jenis_kelamin,
                'agama' => $request->agama,
                'status_perkawinan' => $request->status_perkawinan,
                'alamat' => $request->alamat,
                'no_hp' => $request->no_hp,
                'email' => $request->email,
                'id_opd' => $user->id_opd,
                'pangkat' => $request->pangkat,
                'golongan' => $request->golongan,
                'tmt_pangkat' => $request->tmt_pangkat,
                'jabatan_saat_ini' => $request->jabatan_saat_ini,
                'unit_kerja' => $request->unit_kerja,
                'angka_kredit' => $request->angka_kredit,
                'usia_tahun' => $request->usia_tahun,
                'usia_bulan' => $request->usia_bulan,
                'pendidikan_terakhir' => $request->pendidikan_terakhir,
                'jurusan' => $request->jurusan,
                'tahun_lulus' => $request->tahun_lulus,
            ]);

            return redirect()->route('pegawai.index')->with('success', 'Pegawai berhasil ditambahkan');
            
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Gagal menyimpan: ' . $e->getMessage())->withInput();
        }
    }

    public function show($nip)
    {
        $user = session('user');
        
        if (!$user || $user->role != 'admin_opd') {
            return redirect('/')->with('error', 'Akses ditolak');
        }
        
        $pegawai = Pegawai::where('nip', $nip)->where('id_opd', $user->id_opd)->firstOrFail();
        return view('admin_opd.pegawai.show', compact('pegawai'));
    }

    public function edit($nip)
    {
        $user = session('user');
        
        if (!$user || $user->role != 'admin_opd') {
            return redirect('/')->with('error', 'Akses ditolak');
        }
        
        $pegawai = Pegawai::where('nip', $nip)->where('id_opd', $user->id_opd)->firstOrFail();
        return view('admin_opd.pegawai.edit', compact('pegawai'));
    }

    public function update(Request $request, $nip)
    {
        $user = session('user');
        
        if (!$user || $user->role != 'admin_opd') {
            return redirect('/')->with('error', 'Akses ditolak');
        }
        
        $pegawai = Pegawai::where('nip', $nip)->where('id_opd', $user->id_opd)->firstOrFail();

        $request->validate([
            'nama_lengkap' => 'required',
            'tempat_lahir' => 'required',
            'tanggal_lahir' => 'required|date',
            'jenis_kelamin' => 'required',
            'agama' => 'required',
            'status_perkawinan' => 'required',
            'alamat' => 'required',
            'no_hp' => 'required',
            'email' => 'required|email',
            'pangkat' => 'required',
            'golongan' => 'required',
            'tmt_pangkat' => 'required|date',
            'jabatan_saat_ini' => 'required',
            'unit_kerja' => 'required',
            'angka_kredit' => 'required|numeric',
            'usia_tahun' => 'required|integer',
            'usia_bulan' => 'required|integer',
            'pendidikan_terakhir' => 'required',
            'jurusan' => 'required',
            'tahun_lulus' => 'required|digits:4',
            'no_sertifikat' => 'nullable|string|max:100',
            'masa_berlaku_sertifikat' => 'nullable|date',
            'tahun_predikat_kinerja' => 'nullable|integer|min:2000|max:' . date('Y'),
        ]);

        $pegawai->update([
            'nama_lengkap' => $request->nama_lengkap,
            'tempat_lahir' => $request->tempat_lahir,
            'tanggal_lahir' => $request->tanggal_lahir,
            'jenis_kelamin' => $request->jenis_kelamin,
            'agama' => $request->agama,
            'status_perkawinan' => $request->status_perkawinan,
            'alamat' => $request->alamat,
            'no_hp' => $request->no_hp,
            'email' => $request->email,
            'pangkat' => $request->pangkat,
            'golongan' => $request->golongan,
            'tmt_pangkat' => $request->tmt_pangkat,
            'jabatan_saat_ini' => $request->jabatan_saat_ini,
            'unit_kerja' => $request->unit_kerja,
            'angka_kredit' => $request->angka_kredit,
            'usia_tahun' => $request->usia_tahun,
            'usia_bulan' => $request->usia_bulan,
            'pendidikan_terakhir' => $request->pendidikan_terakhir,
            'jurusan' => $request->jurusan,
            'tahun_lulus' => $request->tahun_lulus,
            'no_sertifikat' => $request->no_sertifikat,
            'masa_berlaku_sertifikat' => $request->masa_berlaku_sertifikat,
            'tahun_predikat_kinerja' => $request->tahun_predikat_kinerja,
        ]);

        return redirect()->route('pegawai.index')->with('success', 'Pegawai berhasil diupdate');
    }

    public function destroy($nip)
    {
        $user = session('user');
        
        if (!$user || $user->role != 'admin_opd') {
            return redirect('/')->with('error', 'Akses ditolak');
        }
        
        $pegawai = Pegawai::where('nip', $nip)->where('id_opd', $user->id_opd)->firstOrFail();
        return redirect()->route('pegawai.index')->with('success', 'Pegawai berhasil dihapus');
    }

    public function nonaktifkan(Request $request, $nip)
    {
        $user = session('user');
        
        if (!$user || $user->role != 'admin_opd') {
            return redirect('/')->with('error', 'Akses ditolak');
        }
        
        $pegawai = Pegawai::where('nip', $nip)->where('id_opd', $user->id_opd)->firstOrFail();
        
        $alasan = $request->input('alasan', 'Pegawai Resign / Diberhentikan');
        
        $pegawai->update(['status_aktif' => 'nonaktif']);

        // Batalkan usulan yang sedang berjalan
        $usulanBerjalan = Usulan::where('nip', $nip)
            ->whereNotIn('status', ['disetujui', 'ditolak', 'dibatalkan'])
            ->get();
            
        foreach ($usulanBerjalan as $usulan) {
            $usulan->update([
                'status' => 'dibatalkan',
                'alasan_pembatalan' => $alasan,
                'tanggal_pembatalan' => Carbon::now()->toDateString()
            ]);
        }
        
        return redirect()->route('pegawai.index')->with('success', 'Pegawai berhasil dinonaktifkan dan usulan yang berjalan telah dibatalkan');
    }
}