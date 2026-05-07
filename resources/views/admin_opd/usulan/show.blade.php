<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Usulan - Admin OPD</title>
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
        .card { background: white; border-radius: 20px; padding: 25px; box-shadow: 0 2px 8px rgba(0,0,0,0.04); max-width: 800px; }
        .card-header { margin-bottom: 20px; border-bottom: 1px solid #e9ecef; padding-bottom: 15px; }
        .card-header h2 { font-size: 20px; font-weight: 600; color: #1e293b; }

        .detail-group { margin-bottom: 20px; }
        .detail-group label { font-weight: 600; color: #1e293b; font-size: 13px; display: block; margin-bottom: 5px; }
        .detail-group p { color: #334155; font-size: 14px; background: #f8fafc; padding: 10px 12px; border-radius: 10px; }

        .status-badge {
            display: inline-block;
            padding: 4px 10px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 500;
        }
        .status-menunggu { background: #fef9c3; color: #854d0e; }
        .status-diverifikasi { background: #dbeafe; color: #1e40af; }
        .status-ditolak { background: #fee2e2; color: #991b1b; }
        .status-selesai { background: #dcfce7; color: #166534; }

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

        @media (max-width: 768px) { .dashboard-wrapper { flex-direction: column; } .sidebar { width: 100%; } }
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
                    <h2><i class="fas fa-eye"></i> Detail Usulan</h2>
                </div>

                <div class="detail-group">
                    <label>Tanggal Pengajuan</label>
                    <p>{{ $usulan->created_at->format('d-m-Y H:i:s') }}</p>
                </div>

                <div class="detail-group">
                    <label>NIP</label>
                    <p>{{ $usulan->nip }}</p>
                </div>

                <div class="detail-group">
                    <label>Nama Pegawai</label>
                    <p>{{ $usulan->pegawai->nama_lengkap ?? '-' }}</p>
                </div>

                <div class="detail-group">
                    <label>Jenis Usulan</label>
                    <p>
                        @if($usulan->jenis_usulan == 'kenaikan')
                            <span class="status-badge status-menunggu">Kenaikan Jabatan</span>
                        @elseif($usulan->jenis_usulan == 'perpindahan')
                            <span class="status-badge status-diverifikasi">Perpindahan</span>
                        @else
                            <span class="status-badge status-ditolak">Pemberhentian</span>
                        @endif
                    </p>
                </div>

                <div class="detail-group">
                    <label>Jabatan Lama</label>
                    <p>{{ $usulan->jabatan_lama }} ({{ $usulan->golongan_lama }})</p>
                </div>

                <div class="detail-group">
                    <label>Unit Kerja Lama</label>
                    <p>{{ $usulan->unit_kerja_lama }}</p>
                </div>

                @if($usulan->jenis_usulan == 'kenaikan')
                <div class="detail-group">
                    <label>Jabatan Baru</label>
                    <p>{{ $usulan->jabatan_baru }} ({{ $usulan->golongan_baru }})</p>
                </div>
                <div class="detail-group">
                    <label>Angka Kredit Usulan</label>
                    <p>{{ number_format($usulan->angka_kredit_usulan, 3, ',', '.') }}</p>
                </div>
                @endif

                @if($usulan->jenis_usulan == 'perpindahan')
                <div class="detail-group">
                    <label>Unit Kerja Tujuan</label>
                    <p>{{ $usulan->unit_kerja_tujuan }}</p>
                </div>
                <div class="detail-group">
                    <label>Alasan Perpindahan</label>
                    <p>{{ $usulan->alasan_perpindahan }}</p>
                </div>
                @endif

                @if($usulan->jenis_usulan == 'pemberhentian')
                <div class="detail-group">
                    <label>Alasan Pemberhentian</label>
                    <p>{{ $usulan->alasan_pemberhentian }}</p>
                </div>
                <div class="detail-group">
                    <label>Tanggal Efektif</label>
                    <p>{{ \Carbon\Carbon::parse($usulan->tanggal_efektif)->format('d-m-Y') }}</p>
                </div>
                @endif

                <!-- DATA SURAT -->
                <div class="detail-group">
                    <label>Nomor Surat</label>
                    <p>{{ $usulan->nomor_surat }}</p>
                </div>

                <div class="detail-group">
                    <label>Nomor Surat PANRB</label>
                    <p>{{ $usulan->no_surat_panrb ?? '-' }}</p>
                </div>

                <div class="detail-group">
                    <label>Jenis Surat</label>
                    <p>{{ $usulan->jenis_surat }}</p>
                </div>

                <div class="detail-group">
                    <label>Banyaknya Bandel</label>
                    <p>{{ $usulan->jumlah_bandel }} bandel</p>
                </div>

                <div class="detail-group">
                    <label>Keterangan</label>
                    <p>{{ $usulan->keterangan_surat }}</p>
                </div>

                <div class="detail-group">
                    <label>Status</label>
                    <p>
                        @if($usulan->status == 'menunggu_verifikasi')
                            <span class="status-badge status-menunggu">Menunggu Verifikasi</span>
                        @elseif($usulan->status == 'sedang_diverifikasi')
                            <span class="status-badge status-diverifikasi">Sedang Diverifikasi</span>
                        @elseif($usulan->status == 'ditolak_verifikator' || $usulan->status == 'ditolak_administrasi')
                            <span class="status-badge status-ditolak">Ditolak</span>
                        @elseif($usulan->status == 'sk_diterbitkan')
                            <span class="status-badge status-selesai">SK Diterbitkan</span>
                        @elseif($usulan->status == 'selesai')
                            <span class="status-badge status-selesai">Selesai</span>
                        @else
                            <span class="status-badge">{{ $usulan->status }}</span>
                        @endif
                    </p>
                </div>

                @if($usulan->alasan_penolakan)
                <div class="detail-group">
                    <label>Alasan Penolakan</label>
                    <p>{{ $usulan->alasan_penolakan }}</p>
                </div>
                @endif

                <div class="detail-group">
                    <a href="{{ route('usulan.index') }}" class="btn-back">
                        <i class="fas fa-arrow-left"></i> Kembali
                    </a>
                </div>
            </div>
        </div>
    </div>
</body>
</html>