<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Usulan - Admin OPD</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="icon" type="image/png" href="{{ asset('images/logobkpsdm.png') }}">
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: 'Inter', sans-serif; background: #f5f7fb; }

        .navbar {
            background: white;
            box-shadow: 0 2px 10px rgba(0,0,0,0.05);
            padding: 12px 30px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .logo-area { display: flex; align-items: center; gap: 12px; }
        .logo-img { width: 42px; height: 42px; object-fit: cover; border-radius: 10px; }
        .logo-text { font-size: 18px; font-weight: 700; background: linear-gradient(135deg, #1e3c72 0%, #2a5298 100%); -webkit-background-clip: text; -webkit-text-fill-color: transparent; }
        .user-info { display: flex; align-items: center; gap: 20px; }
        .user-name { font-weight: 500; color: #333; }
        .logout-btn { background: #ef4444; color: white; text-decoration: none; padding: 8px 18px; border-radius: 8px; font-size: 13px; font-weight: 500; }

        .dashboard-wrapper { display: flex; }
        .sidebar {
            width: 280px;
            background: white;
            min-height: calc(100vh - 66px);
            border-right: 1px solid #e9ecef;
            padding: 25px 0;
            flex-shrink: 0;
        }
        .sidebar-menu { list-style: none; }
        .sidebar-menu li a {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 12px 24px;
            color: #4a5568;
            text-decoration: none;
            font-size: 14px;
            font-weight: 500;
        }
        .sidebar-menu li a i { width: 22px; font-size: 16px; text-align: center; }
        .sidebar-menu li a:hover { background: #f0f4f8; color: #2a5298; }
        .sidebar-menu li.active a { background: linear-gradient(135deg, #1e3c72 0%, #2a5298 100%); color: white; border-radius: 0 20px 20px 0; }

        .main-content { flex: 1; padding: 30px; min-width: 0; }
        .card {
            background: white;
            border-radius: 20px;
            padding: 25px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.04);
            max-width: 800px;
        }
        .card-header { margin-bottom: 20px; border-bottom: 1px solid #e9ecef; padding-bottom: 15px; }
        .card-header h2 { font-size: 20px; font-weight: 600; color: #1e293b; }

        .section-title {
            font-size: 16px;
            font-weight: 700;
            color: #1e293b;
            margin: 20px 0 15px 0;
            padding-left: 10px;
            border-left: 4px solid #2a5298;
        }

        .form-row { display: flex; gap: 20px; margin-bottom: 20px; }
        .form-row .form-group { flex: 1; margin-bottom: 0; }
        .form-group { margin-bottom: 20px; }
        label { display: block; font-weight: 600; margin-bottom: 6px; font-size: 13px; color: #1e293b; }
        input, select, textarea {
            width: 100%;
            padding: 10px 12px;
            border: 1px solid #e2e8f0;
            border-radius: 10px;
            font-family: 'Inter', sans-serif;
            font-size: 14px;
        }
        input:focus, select:focus, textarea:focus { outline: none; border-color: #2a5298; box-shadow: 0 0 0 3px rgba(42,82,152,0.1); }
        textarea { resize: vertical; min-height: 80px; }
        small { display: block; color: #666; font-size: 11px; margin-top: 4px; }

        .form-actions { margin-top: 25px; display: flex; gap: 12px; border-top: 1px solid #e9ecef; padding-top: 20px; }
        .btn-update {
            background: linear-gradient(135deg, #1e3c72 0%, #2a5298 100%);
            color: white;
            padding: 10px 28px;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            font-weight: 600;
            font-size: 14px;
            display: inline-flex;
            align-items: center;
            gap: 8px;
        }
        .btn-update:hover { transform: translateY(-1px); box-shadow: 0 4px 10px rgba(0,0,0,0.1); }
        .btn-back {
            background: #64748b;
            color: white;
            padding: 10px 28px;
            border-radius: 8px;
            text-decoration: none;
            font-size: 14px;
            font-weight: 600;
            display: inline-flex;
            align-items: center;
            gap: 8px;
        }
        .btn-back:hover { background: #475569; transform: translateY(-1px); }
        .alert-error { background: #fee2e2; color: #991b1b; padding: 12px 16px; border-radius: 10px; margin-bottom: 20px; }
        .alert-success { background: #dcfce7; color: #166534; padding: 12px 16px; border-radius: 10px; margin-bottom: 20px; }

        @media (max-width: 768px) { .dashboard-wrapper { flex-direction: column; } .sidebar { width: 100%; } .form-row { flex-direction: column; gap: 20px; } }
    </style>
</head>
<body>
    <div class="navbar">
        <div class="logo-area">
            <img src="{{ asset('images/logobkpsdm.jpg') }}" alt="Logo BKPSDM" class="logo-img">
            <span class="logo-text">Sistem Jabatan Fungsional BKPSDM Kudus</span>
        </div>
        <div class="user-info">
            <span class="user-name"><i class="fas fa-user-circle"></i> {{ session('user')->username }}</span>
            <a href="/logout" class="logout-btn"><i class="fas fa-sign-out-alt"></i> Logout</a>
        </div>
    </div>

    <div class="dashboard-wrapper">
        <div class="sidebar">
            <ul class="sidebar-menu">
                <li><a href="{{ url('/dashboard/admin_opd') }}"><i class="fas fa-chart-line"></i> Dashboard</a></li>
                <li><a href="{{ url('/pegawai') }}"><i class="fas fa-address-card"></i> Data Induk Pegawai</a></li>
                <li class="active"><a href="{{ url('/usulan') }}"><i class="fas fa-file-alt"></i> Data Usulan</a></li>
            </ul>
        </div>

        <div class="main-content">
            <div class="card">
                <div class="card-header">
                    <h2><i class="fas fa-edit"></i> Edit Usulan</h2>
                </div>

                @if(session('success'))
                    <div class="alert-success">
                        <i class="fas fa-check-circle"></i> {{ session('success') }}
                    </div>
                @endif

                @if($errors->any())
                    <div class="alert-error">
                        <i class="fas fa-exclamation-circle"></i> 
                        @foreach($errors->all() as $error)
                            {{ $error }}<br>
                        @endforeach
                    </div>
                @endif

                <form method="POST" action="{{ route('usulan.update', $usulan->id) }}" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <!-- A. DATA PEGAWAI (Readonly) -->
                    <div class="section-title">A. Data Pegawai</div>
                    <div class="form-row">
                        <div class="form-group">
                            <label>NIP</label>
                            <input type="text" value="{{ $usulan->nip }}" readonly style="background:#f5f5f5;">
                        </div>
                        <div class="form-group">
                            <label>Nama Pegawai</label>
                            <input type="text" value="{{ $usulan->pegawai->nama_lengkap ?? '-' }}" readonly style="background:#f5f5f5;">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group">
                            <label>Jabatan Lama</label>
                            <input type="text" value="{{ $usulan->jabatan_lama }} ({{ $usulan->golongan_lama }})" readonly style="background:#f5f5f5;">
                        </div>
                        <div class="form-group">
                            <label>Unit Kerja Lama</label>
                            <input type="text" value="{{ $usulan->unit_kerja_lama }}" readonly style="background:#f5f5f5;">
                        </div>
                    </div>

                    <!-- B. JENIS USULAN (Readonly) -->
                    <div class="section-title">B. Jenis Usulan</div>
                    <div class="form-group">
                        <input type="text" value="{{ $usulan->jenis_usulan == 'promosi' ? 'Promosi (Kenaikan Jabatan)' : ($usulan->jenis_usulan == 'mutasi' ? 'Mutasi (Perpindahan)' : ($usulan->jenis_usulan == 'demosi' ? 'Demosi (Penurunan Jabatan)' : 'Pemberhentian')) }}" readonly style="background:#f5f5f5;">
                    </div>

                    <!-- C. PROMOSI JABATAN -->
                    @if($usulan->jenis_usulan == 'promosi')
                    <div class="section-title">C. Data Promosi Jabatan</div>
                    <div class="form-row">
                        <div class="form-group">
                            <label>Jabatan Baru <span style="color:red;">*</span></label>
                            <input type="text" name="jabatan_baru" value="{{ old('jabatan_baru', $usulan->jabatan_baru) }}" required placeholder="Contoh: Guru Ahli Madya">
                        </div>
                        <div class="form-group">
                            <label>Golongan Baru <span style="color:red;">*</span></label>
                            <select name="golongan_baru" required>
                                <option value="">Pilih Golongan</option>
                                <option value="IV/a" {{ old('golongan_baru', $usulan->golongan_baru) == 'IV/a' ? 'selected' : '' }}>IV/a</option>
                                <option value="IV/b" {{ old('golongan_baru', $usulan->golongan_baru) == 'IV/b' ? 'selected' : '' }}>IV/b</option>
                                <option value="IV/c" {{ old('golongan_baru', $usulan->golongan_baru) == 'IV/c' ? 'selected' : '' }}>IV/c</option>
                                <option value="IV/d" {{ old('golongan_baru', $usulan->golongan_baru) == 'IV/d' ? 'selected' : '' }}>IV/d</option>
                                <option value="IV/e" {{ old('golongan_baru', $usulan->golongan_baru) == 'IV/e' ? 'selected' : '' }}>IV/e</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Angka Kredit Usulan</label>
                        <input type="text" name="angka_kredit_usulan" value="{{ old('angka_kredit_usulan', $usulan->angka_kredit_usulan) }}" placeholder="Angka kredit yang diajukan">
                    </div>
                    @endif

                    <!-- D. MUTASI / DEMOSI -->
                    @if($usulan->jenis_usulan == 'mutasi' || $usulan->jenis_usulan == 'demosi')
                    <div class="section-title">D. Data {{ ucfirst($usulan->jenis_usulan) }}</div>
                    <div class="form-group">
                        <label>Unit Kerja Tujuan <span style="color:red;">*</span></label>
                        <input type="text" name="unit_kerja_tujuan" value="{{ old('unit_kerja_tujuan', $usulan->unit_kerja_tujuan) }}" required placeholder="Contoh: UPTD Puskesmas Jati">
                    </div>
                    <div class="form-group">
                        <label>Alasan {{ ucfirst($usulan->jenis_usulan) }} <span style="color:red;">*</span></label>
                        <textarea name="alasan_perpindahan" rows="2" required placeholder="Jelaskan alasan pemindahan/demosi">{{ old('alasan_perpindahan', $usulan->alasan_perpindahan) }}</textarea>
                    </div>
                    @endif

                    <!-- E. PEMBERHENTIAN -->
                    @if($usulan->jenis_usulan == 'pemberhentian')
                    <div class="section-title">E. Data Pemberhentian</div>
                    <div class="form-group">
                        <label>Alasan Pemberhentian <span style="color:red;">*</span></label>
                        <select name="alasan_pemberhentian" required>
                            <option value="">Pilih Alasan</option>
                            <option value="Pensiun" {{ old('alasan_pemberhentian', $usulan->alasan_pemberhentian) == 'Pensiun' ? 'selected' : '' }}>Pensiun</option>
                            <option value="Meninggal Dunia" {{ old('alasan_pemberhentian', $usulan->alasan_pemberhentian) == 'Meninggal Dunia' ? 'selected' : '' }}>Meninggal Dunia</option>
                            <option value="Mengundurkan Diri" {{ old('alasan_pemberhentian', $usulan->alasan_pemberhentian) == 'Mengundurkan Diri' ? 'selected' : '' }}>Mengundurkan Diri</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Tanggal Efektif <span style="color:red;">*</span></label>
                        <input type="date" name="tanggal_efektif" value="{{ old('tanggal_efektif', $usulan->tanggal_efektif) }}" required>
                    </div>
                    @endif

                    <!-- F. SURAT PENGANTAR -->
                    <div class="section-title">F. Surat Pengantar</div>
                    <div class="form-row">
                        <div class="form-group">
                            <label>Nomor Surat <span style="color:red;">*</span></label>
                            <input type="text" name="nomor_surat" value="{{ old('nomor_surat', $usulan->nomor_surat) }}" required placeholder="Contoh: 800/2026">
                        </div>
                        <div class="form-group">
                            <label>Nomor Surat PANRB</label>
                            <input type="text" name="no_surat_panrb" value="{{ old('no_surat_panrb', $usulan->no_surat_panrb) }}" placeholder="Contoh: B/4748/M.SM.01.00/2026">
                            <small>Nomor surat dari Menteri PANRB (opsional)</small>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group">
                            <label>Jenis Surat <span style="color:red;">*</span></label>
                            <input type="text" name="jenis_surat" value="{{ old('jenis_surat', $usulan->jenis_surat) }}" required placeholder="Contoh: Berkas untuk kenaikan jabatan">
                        </div>
                        <div class="form-group">
                            <label>Banyaknya Bandel <span style="color:red;">*</span></label>
                            <input type="number" name="jumlah_bandel" value="{{ old('jumlah_bandel', $usulan->jumlah_bandel) }}" required min="1">
                            <small>Banyaknya bandel berkas yang dikirim</small>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group">
                            <label>Upload Surat Pengantar (Baru)</label>
                            <input type="file" name="file_surat" accept=".pdf">
                            <small>Kosongkan jika tidak ingin mengubah file. Format PDF, maksimal 2MB</small>
                            @if($usulan->file_surat_pengantar)
                                <small style="display: block; margin-top: 5px;">
                                    <a href="{{ asset('storage/' . $usulan->file_surat_pengantar) }}" target="_blank" style="color: #2a5298;"> Lihat file surat saat ini</a>
                                </small>
                            @endif
                        </div>
                        <div class="form-group">
                            <label>Keterangan <span style="color:red;">*</span></label>
                            <textarea name="keterangan_surat" rows="2" required placeholder="Dikirim dengan hormat untuk mendapatkan penyelesaian lebih lanjut">{{ old('keterangan_surat', $usulan->keterangan_surat) }}</textarea>
                        </div>
                    </div>

                    <!-- G. PERSYARATAN (Upload Ulang Jika Perlu) -->
                    <div class="section-title">G. Persyaratan</div>
                    <div class="alert-success" style="margin-bottom: 15px; padding: 10px;">
                        <i class="fas fa-info-circle"></i> Kosongkan jika tidak ingin mengubah file persyaratan. File yang sudah ada akan tetap digunakan.
                    </div>

                    <div class="form-row">
                        <div class="form-group">
                            <label>SK CPNS</label>
                            <input type="file" name="sk_cpns" accept=".pdf">
                            <small>Format PDF, maksimal 2MB</small>
                            @php $sk_cpns = $usulan->berkas->where('jenis_berkas', 'sk_cpns')->first(); @endphp
                            @if($sk_cpns)
                                <small style="display: block; margin-top: 5px;">
                                    <a href="{{ asset('storage/' . $sk_cpns->path_file) }}" target="_blank" style="color: #2a5298;"> Lihat file SK CPNS saat ini</a>
                                </small>
                            @endif
                        </div>
                        <div class="form-group">
                            <label>SK PNS</label>
                            <input type="file" name="sk_pns" accept=".pdf">
                            <small>Format PDF, maksimal 2MB</small>
                            @php $sk_pns = $usulan->berkas->where('jenis_berkas', 'sk_pns')->first(); @endphp
                            @if($sk_pns)
                                <small style="display: block; margin-top: 5px;">
                                    <a href="{{ asset('storage/' . $sk_pns->path_file) }}" target="_blank" style="color: #2a5298;"> Lihat file SK PNS saat ini</a>
                                </small>
                            @endif
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group">
                            <label>SK Jabatan Terakhir</label>
                            <input type="file" name="sk_jabatan" accept=".pdf">
                            <small>Format PDF, maksimal 2MB</small>
                            @php $sk_jabatan = $usulan->berkas->where('jenis_berkas', 'sk_jabatan')->first(); @endphp
                            @if($sk_jabatan)
                                <small style="display: block; margin-top: 5px;">
                                    <a href="{{ asset('storage/' . $sk_jabatan->path_file) }}" target="_blank" style="color: #2a5298;"> Lihat file SK Jabatan saat ini</a>
                                </small>
                            @endif
                        </div>
                        <div class="form-group">
                            <label>Sertifikat Uji Kompetensi</label>
                            <input type="file" name="sertifikat_uk" accept=".pdf">
                            <small>Format PDF, maksimal 2MB</small>
                            @php $sertifikat = $usulan->berkas->where('jenis_berkas', 'sertifikat_uk')->first(); @endphp
                            @if($sertifikat)
                                <small style="display: block; margin-top: 5px;">
                                    <a href="{{ asset('storage/' . $sertifikat->path_file) }}" target="_blank" style="color: #2a5298;"> Lihat file Sertifikat UK saat ini</a>
                                </small>
                            @endif
                        </div>
                    </div>

                    <div class="form-group">
                        <label>Angka Kredit (PAK)</label>
                        <input type="file" name="angka_kredit" accept=".pdf">
                        <small>Format PDF, maksimal 2MB</small>
                        @php $pak = $usulan->berkas->where('jenis_berkas', 'angka_kredit')->first(); @endphp
                        @if($pak)
                            <small style="display: block; margin-top: 5px;">
                                <a href="{{ asset('storage/' . $pak->path_file) }}" target="_blank" style="color: #2a5298;"> Lihat file Angka Kredit saat ini</a>
                            </small>
                        @endif
                    </div>

                    <div class="form-actions">
                        <button type="submit" class="btn-update">
                            <i class="fas fa-save"></i> Update Usulan
                        </button>
                        <a href="{{ route('usulan.index') }}" class="btn-back">
                            <i class="fas fa-arrow-left"></i> Kembali
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>
</html>