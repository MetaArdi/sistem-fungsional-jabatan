<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Pegawai - Admin OPD</title>
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
            max-width: 700px;
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

        .detail-group {
            margin-bottom: 20px;
        }

        .detail-group label {
            font-weight: 600;
            color: #1e293b;
            font-size: 13px;
            display: block;
            margin-bottom: 5px;
        }

        .detail-group p {
            color: #334155;
            font-size: 14px;
            background: #f8fafc;
            padding: 10px 12px;
            border-radius: 10px;
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

        @media (max-width: 768px) {
            .dashboard-wrapper {
                flex-direction: column;
            }
            .sidebar {
                width: 100%;
                border-right: none;
                border-bottom: 1px solid #e9ecef;
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
                <li><a href="#"><i class="fas fa-history"></i> Riwayat Usulan</a></li>
                <li><a href="#"><i class="fas fa-download"></i> Arsip SK</a></li>
            </ul>
        </div>

        <div class="main-content">
            <div class="card">
                <div class="card-header">
                    <h2><i class="fas fa-eye"></i> Detail Pegawai</h2>
                </div>

                <div class="detail-group">
                    <label>NIP</label>
                    <p>{{ $pegawai->nip }}</p>
                </div>

                <div class="detail-group">
                    <label>Nama Lengkap</label>
                    <p>{{ $pegawai->nama_lengkap }}</p>
                </div>

                <div class="detail-group">
                    <label>Status Kepegawaian</label>
                    <p>
                        @if($pegawai->status_aktif == 'aktif')
                            <span style="background: #dcfce7; color: #166534; padding: 4px 8px; border-radius: 4px; font-size: 13px; font-weight: 500;">Aktif</span>
                        @else
                            <span style="background: #fee2e2; color: #991b1b; padding: 4px 8px; border-radius: 4px; font-size: 13px; font-weight: 500;">Nonaktif / Resign</span>
                        @endif
                    </p>
                </div>

                <div class="detail-group">
                    <label>Tempat, Tanggal Lahir</label>
                    <p>{{ $pegawai->tempat_lahir }}, {{ \Carbon\Carbon::parse($pegawai->tanggal_lahir)->format('d-m-Y') }}</p>
                </div>

                <div class="detail-group">
                    <label>Jenis Kelamin</label>
                    <p>{{ $pegawai->jenis_kelamin == 'L' ? 'Laki-laki' : 'Perempuan' }}</p>
                </div>

                <div class="detail-group">
                    <label>Agama</label>
                    <p>{{ $pegawai->agama }}</p>
                </div>

                <div class="detail-group">
                    <label>Status Perkawinan</label>
                    <p>{{ $pegawai->status_perkawinan }}</p>
                </div>

                <div class="detail-group">
                    <label>Alamat</label>
                    <p>{{ $pegawai->alamat }}</p>
                </div>

                <div class="detail-group">
                    <label>No. HP</label>
                    <p>{{ $pegawai->no_hp }}</p>
                </div>

                <div class="detail-group">
                    <label>Email</label>
                    <p>{{ $pegawai->email }}</p>
                </div>

                 <div class="detail-group">
                    <label>Nomor Sertifikat (REG)</label>
                    <p>{{ $pegawai->no_sertifikat ?? '-' }}</p>
                </div>

                <div class="detail-group">
                    <label>Masa Berlaku Sertifikat</label>
                    <p>{{ $pegawai->masa_berlaku_sertifikat ? \Carbon\Carbon::parse($pegawai->masa_berlaku_sertifikat)->format('d-m-Y') : '-' }}</p>
                </div>

                <div class="detail-group">
                    <label>Pangkat / Golongan</label>
                    <p>{{ $pegawai->pangkat }} / {{ $pegawai->golongan }}</p>
                </div>

                <div class="detail-group">
                    <label>Tahun Predikat Kinerja</label>
                    <p>{{ $pegawai->tahun_predikat_kinerja ?? '-' }}</p>
                </div>

                <div class="detail-group">
                    <label>Pangkat / Golongan</label>
                    <p>{{ $pegawai->pangkat }} / {{ $pegawai->golongan }}</p>
                </div>

                <div class="detail-group">
                    <label>TMT Pangkat</label>
                    <p>{{ \Carbon\Carbon::parse($pegawai->tmt_pangkat)->format('d-m-Y') }}</p>
                </div>

                <div class="detail-group">
                    <label>Jabatan Saat Ini</label>
                    <p>{{ $pegawai->jabatan_saat_ini }}</p>
                </div>

                <div class="detail-group">
                    <label>Unit Kerja</label>
                    <p>{{ $pegawai->unit_kerja }}</p>
                </div>

                <div class="detail-group">
                    <label>Angka Kredit</label>
                    <p>{{ number_format($pegawai->angka_kredit, 3, ',', '.') }}</p>
                </div>

                <div class="detail-group">
                    <label>Usia</label>
                    <p>{{ $pegawai->usia_tahun }} tahun {{ $pegawai->usia_bulan }} bulan</p>
                </div>

                <div class="detail-group">
                    <label>Pendidikan Terakhir</label>
                    <p>{{ $pegawai->pendidikan_terakhir }} - {{ $pegawai->jurusan }} ({{ $pegawai->tahun_lulus }})</p>
                </div>

                <div class="detail-group">
                    <a href="{{ route('pegawai.index') }}" class="btn-back">
                        <i class="fas fa-arrow-left"></i> Kembali
                    </a>
                    @if($pegawai->status_aktif == 'aktif')
                    <form action="{{ route('pegawai.nonaktifkan', $pegawai->nip) }}" method="POST" style="display:inline-block; margin-left: 10px;" onsubmit="return confirm('Yakin ingin menonaktifkan pegawai ini? Semua usulan berjalan akan dibatalkan.')">
                        @csrf
                        <button type="submit" style="background: #f59e0b; color: white; padding: 10px 28px; border-radius: 8px; text-decoration: none; font-size: 14px; font-weight: 600; display: inline-flex; align-items: center; gap: 8px; border: none; cursor: pointer; transition: all 0.2s;">
                            <i class="fas fa-user-times"></i> Nonaktifkan Pegawai
                        </button>
                    </form>
                    @endif
                </div>
            </div>
        </div>
    </div>
</body>
</html>