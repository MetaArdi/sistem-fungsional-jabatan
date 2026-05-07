<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Usulan Baru - Admin OPD</title>
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
        .btn-save {
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
        .btn-save:hover { transform: translateY(-1px); box-shadow: 0 4px 10px rgba(0,0,0,0.1); }
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
                    <h2><i class="fas fa-plus"></i> Usulan Baru</h2>
                </div>

                @if($errors->any())
                    <div class="alert-error">
                        <i class="fas fa-exclamation-circle"></i> 
                        @foreach($errors->all() as $error)
                            {{ $error }}<br>
                        @endforeach
                    </div>
                @endif

                <form method="POST" action="{{ route('usulan.store') }}" enctype="multipart/form-data">
                    @csrf

                    <!-- A. PILIH PEGAWAI -->
                    <div class="section-title">A. Pilih Pegawai</div>
                    <div class="form-group">
                        <label>Pilih Pegawai <span style="color:red;">*</span></label>
                        <select name="nip" id="nip" required>
                            <option value="">Pilih Pegawai</option>
                            @foreach($pegawai as $item)
                                <option value="{{ $item->nip }}" 
                                    data-jabatan="{{ $item->jabatan_saat_ini }}"
                                    data-golongan="{{ $item->golongan }}"
                                    data-unit="{{ $item->unit_kerja }}"
                                    data-angkakredit="{{ $item->angka_kredit }}">
                                    {{ $item->nip }} - {{ $item->nama_lengkap }} ({{ $item->jabatan_saat_ini }})
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-row">
                        <div class="form-group">
                            <label>Jabatan Lama</label>
                            <input type="text" id="jabatan_lama" readonly style="background:#f5f5f5;">
                        </div>
                        <div class="form-group">
                            <label>Golongan Lama</label>
                            <input type="text" id="golongan_lama" readonly style="background:#f5f5f5;">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group">
                            <label>Unit Kerja Lama</label>
                            <input type="text" id="unit_kerja_lama" readonly style="background:#f5f5f5;">
                        </div>
                        <div class="form-group">
                            <label>Angka Kredit Saat Ini</label>
                            <input type="text" id="angka_kredit" readonly style="background:#f5f5f5;">
                        </div>
                    </div>

                    <!-- B. JENIS USULAN -->
                    <div class="section-title">B. Jenis Usulan</div>
                    <div class="form-group">
                        <label>Jenis Usulan <span style="color:red;">*</span></label>
                        <select name="jenis_usulan" id="jenis_usulan" required>
                            <option value="">Pilih Jenis Usulan</option>
                            <option value="promosi">Promosi (Kenaikan Jabatan)</option>
                            <option value="mutasi">Mutasi (Perpindahan)</option>
                            <option value="demosi">Demosi (Penurunan Jabatan)</option>
                            <option value="pemberhentian">Pemberhentian</option>
                        </select>
                    </div>

                    <!-- C. PROMOSI JABATAN -->
                    <div id="form_promosi" style="display: none;">
                        <div class="section-title">C. Data Promosi Jabatan</div>
                        <div class="form-row">
                            <div class="form-group">
                                <label>Jabatan Baru <span style="color:red;">*</span></label>
                                <input type="text" name="jabatan_baru" placeholder="Contoh: Guru Ahli Madya">
                            </div>
                            <div class="form-group">
                                <label>Golongan Baru <span style="color:red;">*</span></label>
                                <select name="golongan_baru">
                                    <option value="">Pilih Golongan</option>
                                    <option value="IV/a">IV/a</option>
                                    <option value="IV/b">IV/b</option>
                                    <option value="IV/c">IV/c</option>
                                    <option value="IV/d">IV/d</option>
                                    <option value="IV/e">IV/e</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Angka Kredit Usulan</label>
                            <input type="text" name="angka_kredit_usulan" placeholder="Angka kredit yang diajukan">
                        </div>
                    </div>

                    <!-- D. MUTASI / DEMOSI -->
                    <div id="form_mutasi_demosi" style="display: none;">
                        <div class="section-title">D. Data Mutasi / Demosi</div>
                        <div class="form-group">
                            <label>Unit Kerja Tujuan <span style="color:red;">*</span></label>
                            <input type="text" name="unit_kerja_tujuan" placeholder="Contoh: UPTD Puskesmas Jati">
                        </div>
                        <div class="form-group">
                            <label>Alasan Perpindahan / Demosi <span style="color:red;">*</span></label>
                            <textarea name="alasan_perpindahan" rows="2" placeholder="Jelaskan alasan pemindahan/demosi"></textarea>
                        </div>
                    </div>

                    <!-- E. PEMBERHENTIAN -->
                    <div id="form_pemberhentian" style="display: none;">
                        <div class="section-title">E. Data Pemberhentian</div>
                        <div class="form-group">
                            <label>Alasan Pemberhentian <span style="color:red;">*</span></label>
                            <select name="alasan_pemberhentian">
                                <option value="">Pilih Alasan</option>
                                <option value="Pensiun">Pensiun</option>
                                <option value="Meninggal Dunia">Meninggal Dunia</option>
                                <option value="Mengundurkan Diri">Mengundurkan Diri</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Tanggal Efektif <span style="color:red;">*</span></label>
                            <input type="date" name="tanggal_efektif">
                        </div>
                    </div>

                    <!-- F. SURAT PENGANTAR -->
                    <div class="section-title">F. Surat Pengantar</div>
                    <div class="form-row">
                        <div class="form-group">
                            <label>Nomor Surat <span style="color:red;">*</span></label>
                            <input type="text" name="nomor_surat" required placeholder="Contoh: 800/2026">
                        </div>
                        <div class="form-group">
                            <label>Nomor Surat PANRB</label>
                            <input type="text" name="no_surat_panrb" placeholder="Contoh: B/4748/M.SM.01.00/2026">
                            <small>Nomor surat dari Menteri PANRB (opsional)</small>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group">
                            <label>Jenis Surat <span style="color:red;">*</span></label>
                            <input type="text" name="jenis_surat" required placeholder="Contoh: Berkas untuk kenaikan jabatan">
                        </div>
                        <div class="form-group">
                            <label>Banyaknya Bandel <span style="color:red;">*</span></label>
                            <input type="number" name="jumlah_bandel" required value="1" min="1">
                            <small>Banyaknya bandel berkas yang dikirim</small>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group">
                            <label>Upload Surat Pengantar <span style="color:red;">*</span></label>
                            <input type="file" name="file_surat" accept=".pdf" required>
                            <small>Format PDF, maksimal 2MB</small>
                        </div>
                        <div class="form-group">
                            <label>Keterangan <span style="color:red;">*</span></label>
                            <textarea name="keterangan_surat" rows="2" required placeholder="Dikirim dengan hormat untuk mendapatkan penyelesaian lebih lanjut"></textarea>
                        </div>
                    </div>

                    <!-- G. PERSYARATAN -->
                    <div class="section-title">G. Persyaratan (Wajib Upload)</div>
                    <div class="form-row">
                        <div class="form-group">
                            <label>SK CPNS</label>
                            <input type="file" name="sk_cpns" accept=".pdf">
                            <small>Format PDF, maksimal 2MB</small>
                        </div>
                        <div class="form-group">
                            <label>SK PNS</label>
                            <input type="file" name="sk_pns" accept=".pdf">
                            <small>Format PDF, maksimal 2MB</small>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group">
                            <label>SK Jabatan Terakhir</label>
                            <input type="file" name="sk_jabatan" accept=".pdf">
                            <small>Format PDF, maksimal 2MB</small>
                        </div>
                        <div class="form-group">
                            <label>Sertifikat Uji Kompetensi</label>
                            <input type="file" name="sertifikat_uk" accept=".pdf">
                            <small>Format PDF, maksimal 2MB</small>
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Angka Kredit (PAK)</label>
                        <input type="file" name="angka_kredit" accept=".pdf">
                        <small>Format PDF, maksimal 2MB</small>
                    </div>

                    <div class="form-actions">
                        <button type="submit" class="btn-save">
                            <i class="fas fa-save"></i> Ajukan Usulan
                        </button>
                        <a href="{{ route('usulan.index') }}" class="btn-back">
                            <i class="fas fa-arrow-left"></i> Kembali
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        // Ambil data pegawai dari database
        const nipSelect = document.getElementById('nip');
        const jabatanLama = document.getElementById('jabatan_lama');
        const golonganLama = document.getElementById('golongan_lama');
        const unitKerjaLama = document.getElementById('unit_kerja_lama');
        const angkaKredit = document.getElementById('angka_kredit');

        nipSelect.addEventListener('change', function() {
            const selected = this.options[this.selectedIndex];
            jabatanLama.value = selected.getAttribute('data-jabatan') || '';
            golonganLama.value = selected.getAttribute('data-golongan') || '';
            unitKerjaLama.value = selected.getAttribute('data-unit') || '';
            angkaKredit.value = selected.getAttribute('data-angkakredit') || '';
        });

        // Tampilkan form sesuai jenis usulan
        const jenisUsulan = document.getElementById('jenis_usulan');
        const formPromosi = document.getElementById('form_promosi');
        const formMutasiDemosi = document.getElementById('form_mutasi_demosi');
        const formPemberhentian = document.getElementById('form_pemberhentian');

        jenisUsulan.addEventListener('change', function() {
            formPromosi.style.display = 'none';
            formMutasiDemosi.style.display = 'none';
            formPemberhentian.style.display = 'none';
            
            if (this.value === 'promosi') {
                formPromosi.style.display = 'block';
            } else if (this.value === 'mutasi' || this.value === 'demosi') {
                formMutasiDemosi.style.display = 'block';
            } else if (this.value === 'pemberhentian') {
                formPemberhentian.style.display = 'block';
            }
        });
    </script>
</body>
</html>