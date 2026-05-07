<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Pegawai - Admin OPD</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="icon" type="image/png" href="{{ asset('images/logobkpsdm.png') }}">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Inter', sans-serif;
            background: #f5f7fb;
        }

        .navbar {
            background: white;
            box-shadow: 0 2px 10px rgba(0,0,0,0.05);
            padding: 12px 30px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            position: sticky;
            top: 0;
            z-index: 100;
        }

        .logo-area {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .logo-img {
            width: 42px;
            height: 42px;
            object-fit: cover;
            border-radius: 10px;
        }

        .logo-text {
            font-size: 18px;
            font-weight: 700;
            background: linear-gradient(135deg, #1e3c72 0%, #2a5298 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        .user-info {
            display: flex;
            align-items: center;
            gap: 20px;
        }

        .user-name {
            font-weight: 500;
            color: #333;
        }

        .logout-btn {
            background: #ef4444;
            color: white;
            text-decoration: none;
            padding: 8px 18px;
            border-radius: 8px;
            font-size: 13px;
            font-weight: 500;
            transition: all 0.2s;
        }

        .logout-btn:hover {
            background: #dc2626;
            transform: translateY(-1px);
        }

        .dashboard-wrapper {
            display: flex;
        }

        .sidebar {
            width: 280px;
            background: white;
            min-height: calc(100vh - 66px);
            border-right: 1px solid #e9ecef;
            padding: 25px 0;
            flex-shrink: 0;
        }

        .sidebar-menu {
            list-style: none;
        }

        .sidebar-menu li a {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 12px 24px;
            color: #4a5568;
            text-decoration: none;
            font-size: 14px;
            font-weight: 500;
            transition: all 0.2s;
        }

        .sidebar-menu li a i {
            width: 22px;
            font-size: 16px;
            text-align: center;
        }

        .sidebar-menu li a:hover {
            background: #f0f4f8;
            color: #2a5298;
        }

        .sidebar-menu li.active a {
            background: linear-gradient(135deg, #1e3c72 0%, #2a5298 100%);
            color: white;
            border-radius: 0 20px 20px 0;
        }

        .main-content {
            flex: 1;
            padding: 30px;
            min-width: 0;
        }

        .card {
            background: white;
            border-radius: 20px;
            padding: 25px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.04);
            max-width: 800px;
        }

        .card-header {
            margin-bottom: 20px;
            border-bottom: 1px solid #e9ecef;
            padding-bottom: 15px;
        }

        .card-header h2 {
            font-size: 20px;
            font-weight: 600;
            color: #1e293b;
        }

        .form-row {
            display: flex;
            gap: 20px;
            margin-bottom: 20px;
        }

        .form-row .form-group {
            flex: 1;
            margin-bottom: 0;
        }

        .form-group {
            margin-bottom: 20px;
        }

        label {
            display: block;
            font-weight: 600;
            margin-bottom: 6px;
            font-size: 13px;
            color: #1e293b;
        }

        input, select {
            width: 100%;
            padding: 10px 12px;
            border: 1px solid #e2e8f0;
            border-radius: 10px;
            font-family: 'Inter', sans-serif;
            font-size: 14px;
            transition: all 0.2s;
        }

        input:focus, select:focus {
            outline: none;
            border-color: #2a5298;
            box-shadow: 0 0 0 3px rgba(42,82,152,0.1);
        }

        textarea {
            width: 100%;
            padding: 10px 12px;
            border: 1px solid #e2e8f0;
            border-radius: 10px;
            font-family: 'Inter', sans-serif;
            font-size: 14px;
            resize: vertical;
            min-height: 80px;
        }

        textarea:focus {
            outline: none;
            border-color: #2a5298;
            box-shadow: 0 0 0 3px rgba(42,82,152,0.1);
        }

        small {
            display: block;
            color: #666;
            font-size: 11px;
            margin-top: 4px;
        }

        .section-title {
            font-size: 16px;
            font-weight: 700;
            color: #1e293b;
            margin: 20px 0 15px 0;
            padding-left: 10px;
            border-left: 4px solid #2a5298;
        }

        .form-actions {
            margin-top: 25px;
            display: flex;
            gap: 12px;
            border-top: 1px solid #e9ecef;
            padding-top: 20px;
        }

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
            transition: all 0.2s;
        }

        .btn-save:hover {
            transform: translateY(-1px);
            box-shadow: 0 4px 10px rgba(0,0,0,0.1);
        }

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
            transition: all 0.2s;
        }

        .btn-back:hover {
            background: #475569;
            transform: translateY(-1px);
        }

        .alert-error {
            background: #fee2e2;
            color: #991b1b;
            padding: 12px 16px;
            border-radius: 10px;
            margin-bottom: 20px;
            font-size: 13px;
        }

        @media (max-width: 768px) {
            .dashboard-wrapper {
                flex-direction: column;
            }
            .sidebar {
                width: 100%;
                border-right: none;
                border-bottom: 1px solid #e9ecef;
            }
            .form-row {
                flex-direction: column;
                gap: 20px;
            }
        }
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
                <li class="active"><a href="{{ url('/pegawai') }}"><i class="fas fa-address-card"></i> Data Induk Pegawai</a></li>
                <li><a href="{{ url('/usulan') }}"><i class="fas fa-file-alt"></i> Data Usulan</a></li>
            </ul>
        </div>

        <div class="main-content">
            <div class="card">
                <div class="card-header">
                    <h2><i class="fas fa-plus"></i> Tambah Data Induk Pegawai</h2>
                </div>

                @if($errors->any())
                    <div class="alert-error">
                        <i class="fas fa-exclamation-circle"></i> 
                        @foreach($errors->all() as $error)
                            {{ $error }}<br>
                        @endforeach
                    </div>
                @endif

                <form method="POST" action="{{ route('pegawai.store') }}">
                    @csrf

                    <!-- A. DATA PRIBADI -->
                    <div class="section-title">A. DATA PRIBADI</div>

                    <div class="form-row">
                        <div class="form-group">
                            <label>NIP <span style="color:red;">*</span></label>
                            <input type="text" name="nip" value="{{ old('nip') }}" required placeholder="18 digit">
                            <small>Nomor Induk Pegawai (18 digit)</small>
                        </div>
                        <div class="form-group">
                            <label>Nama Lengkap <span style="color:red;">*</span></label>
                            <input type="text" name="nama_lengkap" value="{{ old('nama_lengkap') }}" required placeholder="Contoh: Acelia Putri Rahmawati, S.Pd">
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group">
                            <label>Tempat Lahir <span style="color:red;">*</span></label>
                            <input type="text" name="tempat_lahir" value="{{ old('tempat_lahir') }}" required>
                        </div>
                        <div class="form-group">
                            <label>Tanggal Lahir <span style="color:red;">*</span></label>
                            <input type="date" name="tanggal_lahir" value="{{ old('tanggal_lahir') }}" required>
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group">
                            <label>Jenis Kelamin <span style="color:red;">*</span></label>
                            <select name="jenis_kelamin" required>
                                <option value="">Pilih</option>
                                <option value="L" {{ old('jenis_kelamin') == 'L' ? 'selected' : '' }}>Laki-laki</option>
                                <option value="P" {{ old('jenis_kelamin') == 'P' ? 'selected' : '' }}>Perempuan</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Agama <span style="color:red;">*</span></label>
                            <select name="agama" required>
                                <option value="">Pilih</option>
                                <option value="Islam" {{ old('agama') == 'Islam' ? 'selected' : '' }}>Islam</option>
                                <option value="Kristen" {{ old('agama') == 'Kristen' ? 'selected' : '' }}>Kristen</option>
                                <option value="Katolik" {{ old('agama') == 'Katolik' ? 'selected' : '' }}>Katolik</option>
                                <option value="Hindu" {{ old('agama') == 'Hindu' ? 'selected' : '' }}>Hindu</option>
                                <option value="Buddha" {{ old('agama') == 'Buddha' ? 'selected' : '' }}>Buddha</option>
                                <option value="Konghucu" {{ old('agama') == 'Konghucu' ? 'selected' : '' }}>Konghucu</option>
                            </select>
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group">
                            <label>Status Perkawinan <span style="color:red;">*</span></label>
                            <select name="status_perkawinan" required>
                                <option value="">Pilih</option>
                                <option value="Kawin" {{ old('status_perkawinan') == 'Kawin' ? 'selected' : '' }}>Kawin</option>
                                <option value="Belum Kawin" {{ old('status_perkawinan') == 'Belum Kawin' ? 'selected' : '' }}>Belum Kawin</option>
                                <option value="Cerai" {{ old('status_perkawinan') == 'Cerai' ? 'selected' : '' }}>Cerai</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>No. HP <span style="color:red;">*</span></label>
                            <input type="text" name="no_hp" value="{{ old('no_hp') }}" required placeholder="Contoh: 081234567890">
                        </div>
                    </div>

                    <div class="form-group">
                        <label>Alamat <span style="color:red;">*</span></label>
                        <textarea name="alamat" rows="2" required>{{ old('alamat') }}</textarea>
                    </div>

                    <div class="form-group">
                        <label>Email Pribadi <span style="color:red;">*</span></label>
                        <input type="email" name="email" value="{{ old('email') }}" required>
                    </div>

                    <!-- D. DATA SERTIFIKAT (BARU) -->
                    <div class="section-title">D. DATA SERTIFIKAT</div>

                    <div class="form-row">
                        <div class="form-group">
                            <label>Nomor Sertifikat (REG)</label>
                            <input type="text" name="no_sertifikat" value="{{ old('no_sertifikat') }}" placeholder="Contoh: REG-12345678">
                            <small>Nomor sertifikat uji kompetensi</small>
                        </div>
                        <div class="form-group">
                            <label>Masa Berlaku Sertifikat</label>
                            <input type="date" name="masa_berlaku_sertifikat" value="{{ old('masa_berlaku_sertifikat') }}">
                            <small>Tanggal berakhirnya sertifikat</small>
                        </div>
                    </div>

                    <div class="form-group">
                        <label>Tahun Predikat Kinerja</label>
                        <input type="number" name="tahun_predikat_kinerja" value="{{ old('tahun_predikat_kinerja', date('Y') - 1) }}" placeholder="Contoh: 2025" min="2000" max="{{ date('Y') }}">
                        <small>Tahun terakhir predikat kinerja</small>
                    </div>

                    <!-- B. DATA KEPEGAWAIAN -->
                    <div class="section-title">B. DATA KEPEGAWAIAN (SAAT INI)</div>

                    <div class="form-row">
                        <div class="form-group">
                            <label>Pangkat <span style="color:red;">*</span></label>
                            <select name="pangkat" required>
                                <option value="">Pilih</option>
                                <option value="Juru Muda" {{ old('pangkat') == 'Juru Muda' ? 'selected' : '' }}>Juru Muda</option>
                                <option value="Juru Muda Tingkat I" {{ old('pangkat') == 'Juru Muda Tingkat I' ? 'selected' : '' }}>Juru Muda Tingkat I</option>
                                <option value="Juru" {{ old('pangkat') == 'Juru' ? 'selected' : '' }}>Juru</option>
                                <option value="Pengatur Muda" {{ old('pangkat') == 'Pengatur Muda' ? 'selected' : '' }}>Pengatur Muda</option>
                                <option value="Pengatur Muda Tingkat I" {{ old('pangkat') == 'Pengatur Muda Tingkat I' ? 'selected' : '' }}>Pengatur Muda Tingkat I</option>
                                <option value="Pengatur" {{ old('pangkat') == 'Pengatur' ? 'selected' : '' }}>Pengatur</option>
                                <option value="Penata Muda" {{ old('pangkat') == 'Penata Muda' ? 'selected' : '' }}>Penata Muda</option>
                                <option value="Penata Muda Tingkat I" {{ old('pangkat') == 'Penata Muda Tingkat I' ? 'selected' : '' }}>Penata Muda Tingkat I</option>
                                <option value="Penata" {{ old('pangkat') == 'Penata' ? 'selected' : '' }}>Penata</option>
                                <option value="Penata Tingkat I" {{ old('pangkat') == 'Penata Tingkat I' ? 'selected' : '' }}>Penata Tingkat I</option>
                                <option value="Pembina" {{ old('pangkat') == 'Pembina' ? 'selected' : '' }}>Pembina</option>
                                <option value="Pembina Tingkat I" {{ old('pangkat') == 'Pembina Tingkat I' ? 'selected' : '' }}>Pembina Tingkat I</option>
                                <option value="Pembina Utama Muda" {{ old('pangkat') == 'Pembina Utama Muda' ? 'selected' : '' }}>Pembina Utama Muda</option>
                                <option value="Pembina Utama Madya" {{ old('pangkat') == 'Pembina Utama Madya' ? 'selected' : '' }}>Pembina Utama Madya</option>
                                <option value="Pembina Utama" {{ old('pangkat') == 'Pembina Utama' ? 'selected' : '' }}>Pembina Utama</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Golongan <span style="color:red;">*</span></label>
                            <select name="golongan" required>
                                <option value="">Pilih</option>
                                <option value="I/a" {{ old('golongan') == 'I/a' ? 'selected' : '' }}>I/a</option>
                                <option value="I/b" {{ old('golongan') == 'I/b' ? 'selected' : '' }}>I/b</option>
                                <option value="I/c" {{ old('golongan') == 'I/c' ? 'selected' : '' }}>I/c</option>
                                <option value="I/d" {{ old('golongan') == 'I/d' ? 'selected' : '' }}>I/d</option>
                                <option value="II/a" {{ old('golongan') == 'II/a' ? 'selected' : '' }}>II/a</option>
                                <option value="II/b" {{ old('golongan') == 'II/b' ? 'selected' : '' }}>II/b</option>
                                <option value="II/c" {{ old('golongan') == 'II/c' ? 'selected' : '' }}>II/c</option>
                                <option value="II/d" {{ old('golongan') == 'II/d' ? 'selected' : '' }}>II/d</option>
                                <option value="III/a" {{ old('golongan') == 'III/a' ? 'selected' : '' }}>III/a</option>
                                <option value="III/b" {{ old('golongan') == 'III/b' ? 'selected' : '' }}>III/b</option>
                                <option value="III/c" {{ old('golongan') == 'III/c' ? 'selected' : '' }}>III/c</option>
                                <option value="III/d" {{ old('golongan') == 'III/d' ? 'selected' : '' }}>III/d</option>
                                <option value="IV/a" {{ old('golongan') == 'IV/a' ? 'selected' : '' }}>IV/a</option>
                                <option value="IV/b" {{ old('golongan') == 'IV/b' ? 'selected' : '' }}>IV/b</option>
                                <option value="IV/c" {{ old('golongan') == 'IV/c' ? 'selected' : '' }}>IV/c</option>
                                <option value="IV/d" {{ old('golongan') == 'IV/d' ? 'selected' : '' }}>IV/d</option>
                                <option value="IV/e" {{ old('golongan') == 'IV/e' ? 'selected' : '' }}>IV/e</option>
                            </select>
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group">
                            <label>TMT Pangkat <span style="color:red;">*</span></label>
                            <input type="date" name="tmt_pangkat" value="{{ old('tmt_pangkat') }}" required>
                            <small>Tanggal Mulai Berlaku Pangkat</small>
                        </div>
                        <div class="form-group">
                            <label>Angka Kredit <span style="color:red;">*</span></label>
                            <input type="text" name="angka_kredit" value="{{ old('angka_kredit') }}" required placeholder="Contoh: 360.086">
                            <small>Gunakan titik sebagai pemisah ribuan</small>
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group">
                            <label>Jabatan Saat Ini <span style="color:red;">*</span></label>
                            <input type="text" name="jabatan_saat_ini" value="{{ old('jabatan_saat_ini') }}" required>
                        </div>
                        <div class="form-group">
                            <label>Unit Kerja <span style="color:red;">*</span></label>
                            <input type="text" name="unit_kerja" value="{{ old('unit_kerja') }}" required>
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group">
                            <label>Usia (Tahun) <span style="color:red;">*</span></label>
                            <input type="number" name="usia_tahun" value="{{ old('usia_tahun') }}" required min="0" max="100">
                        </div>
                        <div class="form-group">
                            <label>Usia (Bulan) <span style="color:red;">*</span></label>
                            <input type="number" name="usia_bulan" value="{{ old('usia_bulan') }}" required min="0" max="11">
                        </div>
                    </div>

                    <!-- C. DATA PENDIDIKAN -->
                    <div class="section-title">C. DATA PENDIDIKAN</div>

                    <div class="form-row">
                        <div class="form-group">
                            <label>Pendidikan Terakhir <span style="color:red;">*</span></label>
                            <select name="pendidikan_terakhir" required>
                                <option value="">Pilih</option>
                                <option value="SD" {{ old('pendidikan_terakhir') == 'SD' ? 'selected' : '' }}>SD</option>
                                <option value="SMP" {{ old('pendidikan_terakhir') == 'SMP' ? 'selected' : '' }}>SMP</option>
                                <option value="SMA" {{ old('pendidikan_terakhir') == 'SMA' ? 'selected' : '' }}>SMA</option>
                                <option value="D1" {{ old('pendidikan_terakhir') == 'D1' ? 'selected' : '' }}>D1</option>
                                <option value="D2" {{ old('pendidikan_terakhir') == 'D2' ? 'selected' : '' }}>D2</option>
                                <option value="D3" {{ old('pendidikan_terakhir') == 'D3' ? 'selected' : '' }}>D3</option>
                                <option value="D4" {{ old('pendidikan_terakhir') == 'D4' ? 'selected' : '' }}>D4</option>
                                <option value="S1" {{ old('pendidikan_terakhir') == 'S1' ? 'selected' : '' }}>S1</option>
                                <option value="S2" {{ old('pendidikan_terakhir') == 'S2' ? 'selected' : '' }}>S2</option>
                                <option value="S3" {{ old('pendidikan_terakhir') == 'S3' ? 'selected' : '' }}>S3</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Jurusan <span style="color:red;">*</span></label>
                            <input type="text" name="jurusan" value="{{ old('jurusan') }}" required>
                        </div>
                    </div>

                    <div class="form-group">
                        <label>Tahun Lulus <span style="color:red;">*</span></label>
                        <input type="number" name="tahun_lulus" value="{{ old('tahun_lulus') }}" required min="1950" max="2030">
                    </div>

                    <div class="form-actions">
                        <button type="submit" class="btn-save">
                            <i class="fas fa-save"></i> Simpan
                        </button>
                        <a href="{{ route('pegawai.index') }}" class="btn-back">
                            <i class="fas fa-arrow-left"></i> Kembali
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>
</html>