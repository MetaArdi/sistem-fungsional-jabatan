<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Bahan Rapat - Verifikator</title>
    <link href="https://fonts.googleapis.com/css2?family=Times+New+Roman&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="icon" type="image/png" href="{{ asset('images/logobkpsdm.png') }}">  
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: 'Times New Roman', Times, serif; background: #f5f7fb; }

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
        .logo-text { font-size: 18px; font-weight: 700; background: linear-gradient(135deg, #1e3c72 0%, #2a5298 100%); -webkit-background-clip: text; -webkit-text-fill-color: transparent; font-family: 'Times New Roman', Times, serif; }
        .user-info { display: flex; align-items: center; gap: 20px; }
        .user-name { font-weight: 500; color: #333; font-family: 'Times New Roman', Times, serif; }
        .logout-btn { background: #ef4444; color: white; text-decoration: none; padding: 8px 18px; border-radius: 8px; font-size: 13px; font-weight: 500; font-family: 'Times New Roman', Times, serif; }

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
            font-family: 'Times New Roman', Times, serif;
        }
        .sidebar-menu li a i { width: 22px; font-size: 16px; text-align: center; }
        .sidebar-menu li a:hover { background: #f0f4f8; color: #2a5298; }
        .sidebar-menu li.active a { background: linear-gradient(135deg, #1e3c72 0%, #2a5298 100%); color: white; border-radius: 0 20px 20px 0; }

        .main-content { flex: 1; padding: 30px; min-width: 0; }
        .card { background: white; border-radius: 20px; padding: 25px; box-shadow: 0 2px 8px rgba(0,0,0,0.04); max-width: 1000px; }
        .card-header { margin-bottom: 20px; border-bottom: 1px solid #e9ecef; padding-bottom: 15px; }
        .card-header h2 { font-size: 20px; font-weight: 600; color: #1e293b; font-family: 'Times New Roman', Times, serif; }

        .section-title {
            font-size: 16px;
            font-weight: 700;
            color: #1e293b;
            margin: 20px 0 15px 0;
            padding-left: 10px;
            border-left: 4px solid #2a5298;
            font-family: 'Times New Roman', Times, serif;
        }

        .detail-group { margin-bottom: 15px; }
        .detail-group label { font-weight: 600; color: #1e293b; font-size: 13px; display: block; margin-bottom: 5px; font-family: 'Times New Roman', Times, serif; }
        .detail-group p { color: #334155; font-size: 14px; background: #f8fafc; padding: 8px 12px; border-radius: 8px; font-family: 'Times New Roman', Times, serif; }

        .kajian-box {
            background: #f8fafc;
            padding: 15px;
            border-radius: 10px;
            border-left: 4px solid #2a5298;
            white-space: pre-line;
            font-size: 14px;
            line-height: 1.6;
            font-family: 'Times New Roman', Times, serif;
        }

        .status-badge {
            display: inline-block;
            padding: 4px 10px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 500;
            font-family: 'Times New Roman', Times, serif;
        }
        .status-menunggu { background: #fef9c3; color: #854d0e; }
        .status-disetujui { background: #dcfce7; color: #166534; }
        .status-ditolak { background: #fee2e2; color: #991b1b; }

        .btn-draft {
            background: #f59e0b;
            color: white;
            padding: 10px 24px;
            border-radius: 8px;
            text-decoration: none;
            font-weight: 600;
            font-size: 14px;
            font-family: 'Times New Roman', Times, serif;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            transition: all 0.2s;
        }
        .btn-draft:hover { background: #d97706; transform: translateY(-1px); }
        
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
            font-family: 'Times New Roman', Times, serif;
            transition: all 0.2s;
        }
        .btn-back:hover { background: #475569; transform: translateY(-1px); }

        hr {
            margin: 20px 0;
            border: none;
            border-top: 1px solid #e9ecef;
        }

        @media (max-width: 768px) { 
            .dashboard-wrapper { flex-direction: column; } 
            .sidebar { width: 100%; }
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
                <li><a href="{{ url('/dashboard/verifikator') }}"><i class="fas fa-chart-line"></i> Dashboard</a></li>
                <li><a href="{{ url('/verifikasi') }}"><i class="fas fa-check-circle"></i> Verifikasi Usulan</a></li>
                <li class="active"><a href="{{ url('/bahan-rapat/verifikator') }}"><i class="fas fa-file-alt"></i> Bahan Rapat</a></li>
            </ul>
        </div>

        <div class="main-content">
            <div class="card">
                <div class="card-header">
                    <h2><i class="fas fa-file-alt"></i> Detail Bahan Rapat</h2>
                </div>

                <div class="detail-group">
                    <label>Nomor Bahan</label>
                    <p>{{ $bahanRapat->nomor_bahan }}</p>
                </div>

                <div class="detail-group">
                    <label>Tanggal Bahan</label>
                    <p>{{ \Carbon\Carbon::parse($bahanRapat->tanggal_bahan)->format('d-m-Y') }}</p>
                </div>

                <div class="detail-group">
                    <label>Status</label>
                    <p>
                        @if($bahanRapat->status_bahan == 'menunggu_persetujuan')
                            <span class="status-badge status-menunggu">Menunggu Persetujuan</span>
                        @elseif($bahanRapat->status_bahan == 'disetujui')
                            <span class="status-badge status-disetujui">Disetujui</span>
                        @else
                            <span class="status-badge status-ditolak">Ditolak</span>
                        @endif
                    </p>
                </div>

                @if($bahanRapat->alasan_persetujuan)
                <div class="detail-group">
                    <label>Alasan / Keterangan</label>
                    <p>{{ $bahanRapat->alasan_persetujuan }}</p>
                </div>
                @endif

                <!-- DATA PEGAWAI & USULAN (LOOP UNTUK MULTIPLE USULAN) -->
                @foreach($usulanList as $index => $usul)
                <div class="section-title">Data Pegawai {{ $index + 1 }}</div>
                <div class="detail-group">
                    <label>Nama Pegawai</label>
                    <p>{{ $usul->pegawai->nama_lengkap ?? '-' }}</p>
                </div>
                <div class="detail-group">
                    <label>NIP</label>
                    <p>{{ $usul->pegawai->nip ?? '-' }}</p>
                </div>
                <div class="detail-group">
                    <label>Pangkat / Golongan</label>
                    <p>{{ $usul->pegawai->pangkat ?? '-' }} / {{ $usul->pegawai->golongan ?? '-' }}</p>
                </div>
                <div class="detail-group">
                    <label>Unit Kerja</label>
                    <p>{{ $usul->unit_kerja_lama }}</p>
                </div>

                <div class="section-title">Data Usulan {{ $index + 1 }}</div>
                <div class="detail-group">
                    <label>Jenis Usulan</label>
                    <p>
                        @if($usul->jenis_usulan == 'kenaikan')
                            Kenaikan Jabatan
                        @elseif($usul->jenis_usulan == 'perpindahan')
                            Perpindahan
                        @else
                            Pemberhentian
                        @endif
                    </p>
                </div>
                <div class="detail-group">
                    <label>Jabatan Lama</label>
                    <p>{{ $usul->jabatan_lama }} ({{ $usul->golongan_lama }})</p>
                </div>
                @if($usul->jenis_usulan == 'kenaikan')
                <div class="detail-group">
                    <label>Jabatan Baru</label>
                    <p>{{ $usul->jabatan_baru }} ({{ $usul->golongan_baru }})</p>
                </div>
                @endif
                
                @if(!$loop->last)
                <hr>
                @endif
                @endforeach

                <!-- KAJIAN (READONLY - OTOMATIS DARI DATABASE) -->
                <div class="section-title">Kajian</div>
                <div class="kajian-box">
                    {{ $bahanRapat->kajian_otomatis }}
                </div>

                <hr>

                <!-- DOWNLOAD BUTTON (HANYA DRAFT UNTUK VERIFIKATOR) -->
                <div style="display: flex; gap: 12px; margin-top: 20px; flex-wrap: wrap;">
                    <a href="{{ url('/bahan-rapat/' . $bahanRapat->id . '/download-draft') }}" class="btn-draft">
                        <i class="fas fa-file-word"></i> Download Draft
                    </a>
                </div>

                <!-- BACK BUTTON -->
                <div style="margin-top: 20px;">
                    <a href="{{ url('/bahan-rapat/verifikator') }}" class="btn-back">
                        <i class="fas fa-arrow-left"></i> Kembali
                    </a>
                </div>

            </div>
        </div>
    </div>
</body>
</html>