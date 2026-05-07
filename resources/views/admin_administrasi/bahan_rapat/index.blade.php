<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bahan Rapat - Admin Administrasi</title>
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
        .card { background: white; border-radius: 20px; padding: 25px; box-shadow: 0 2px 8px rgba(0,0,0,0.04); }
        .card-header { margin-bottom: 20px; border-bottom: 1px solid #e9ecef; padding-bottom: 15px; }
        .card-header h2 { font-size: 20px; font-weight: 600; color: #1e293b; }

        .table-responsive { overflow-x: auto; }
        table { width: 100%; border-collapse: collapse; min-width: 800px; }
        th, td { padding: 12px 15px; text-align: left; border-bottom: 1px solid #e9ecef; }
        th { background: #f8fafc; font-weight: 600; color: #1e293b; font-size: 13px; }
        td { font-size: 13px; color: #334155; }

        .status-badge {
            display: inline-block;
            padding: 4px 10px;
            border-radius: 20px;
            font-size: 11px;
            font-weight: 500;
        }
        .status-menunggu { background: #fef9c3; color: #854d0e; }
        .status-disetujui { background: #dcfce7; color: #166534; }
        .status-ditolak { background: #fee2e2; color: #991b1b; }

        .btn-detail {
            background: #3b82f6;
            color: white;
            padding: 6px 14px;
            border-radius: 6px;
            text-decoration: none;
            font-size: 12px;
            display: inline-flex;
            align-items: center;
            gap: 6px;
        }
        .btn-detail:hover { background: #2563eb; }

        .alert-success { background: #dcfce7; color: #166534; padding: 12px; border-radius: 10px; margin-bottom: 20px; }
        .alert-error { background: #fee2e2; color: #991b1b; padding: 12px; border-radius: 10px; margin-bottom: 20px; }

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
                <li class="{{ Request::is('dashboard/admin_administrasi') ? 'active' : '' }}">
                    <a href="{{ url('/dashboard/admin_administrasi') }}"><i class="fas fa-chart-line"></i> Dashboard</a>
                </li>
                <li class="{{ Request::is('bahan-rapat/admin*') ? 'active' : '' }}">
                    <a href="{{ url('/bahan-rapat/admin') }}"><i class="fas fa-file-alt"></i> Bahan Rapat</a>
                </li>
                <li class="{{ Request::is('admin_administrasi/sk') || Request::is('admin_administrasi/sk/create') || Request::is('admin_administrasi/sk/*/edit') ? 'active' : '' }}">
                    <a href="{{ url('/admin_administrasi/sk') }}"><i class="fas fa-certificate"></i> Kelola SK</a>
                </li>
                <li class="{{ Request::is('admin_administrasi/sk/arsip') ? 'active' : '' }}">
                    <a href="{{ url('/admin_administrasi/sk/arsip') }}"><i class="fas fa-archive"></i> Arsip SK</a>
                </li>
                <li class="{{ Request::is('admin_administrasi/riwayat-usulan') ? 'active' : '' }}">
                    <a href="{{ url('/admin_administrasi/riwayat-usulan') }}"><i class="fas fa-history"></i> Riwayat Usulan</a>
                </li>
                <li class="{{ Request::is('admin_administrasi/laporan/rekap-usulan') ? 'active' : '' }}">
                    <a href="{{ url('/admin_administrasi/laporan/rekap-usulan') }}"><i class="fas fa-chart-bar"></i> Laporan Rekap Usulan</a>
                </li>
                <li class="{{ Request::is('admin_administrasi/log-integrasi') ? 'active' : '' }}">
                    <a href="{{ url('/admin_administrasi/log-integrasi') }}"><i class="fas fa-exchange-alt"></i> Log Integrasi</a>
                </li>
            </ul>
        </div>

        <div class="main-content">
            <div class="card">
                <div class="card-header">
                    <h2><i class="fas fa-file-alt"></i> Bahan Rapat</h2>
                </div>

                @if(session('success'))
                    <div class="alert-success">
                        <i class="fas fa-check-circle"></i> {{ session('success') }}
                    </div>
                @endif

                @if(session('error'))
                    <div class="alert-error">
                        <i class="fas fa-exclamation-circle"></i> {{ session('error') }}
                    </div>
                @endif

                <div class="table-responsive">
                    <table>
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nomor Bahan</th>
                                <th>Tanggal Bahan</th>
                                <th>Nama Pegawai</th>
                                <th>NIP</th>
                                <th>Jenis Usulan</th>
                                <th>Status</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($bahanRapat as $key => $item)
                            <tr>
                                <td>{{ $key + 1 }}</td>
                                <td>{{ $item->nomor_bahan }}</td>
                                <td>{{ \Carbon\Carbon::parse($item->tanggal_bahan)->format('d-m-Y') }}</td>
                                <!-- NAMA PEGAWAI (support multiple usulan) -->
                                <td>
                                    @foreach($item->usulan as $usul)
                                        {{ $usul->pegawai->nama_lengkap ?? '-' }}<br>
                                    @endforeach
                                </td>
                                <!-- NIP (support multiple usulan) -->
                                <td>
                                    @foreach($item->usulan as $usul)
                                        {{ $usul->pegawai->nip ?? '-' }}<br>
                                    @endforeach
                                </td>
                                <!-- JENIS USULAN (support multiple usulan) -->
                                <td>
                                    @foreach($item->usulan as $usul)
                                        @if($usul->jenis_usulan == 'kenaikan')
                                            Kenaikan Jabatan<br>
                                        @elseif($usul->jenis_usulan == 'perpindahan')
                                            Perpindahan<br>
                                        @else
                                            Pemberhentian<br>
                                        @endif
                                    @endforeach
                                </td>
                                <td>
                                    @if($item->status_bahan == 'menunggu_persetujuan')
                                        <span class="status-badge status-menunggu">Menunggu Persetujuan</span>
                                    @elseif($item->status_bahan == 'disetujui')
                                        <span class="status-badge status-disetujui">Disetujui</span>
                                    @else
                                        <span class="status-badge status-ditolak">Ditolak</span>
                                    @endif
                                </td>
                                <td>
                                    <a href="{{ url('/bahan-rapat/admin/' . $item->id) }}" class="btn-detail">
                                        <i class="fas fa-eye"></i> Detail
                                    </a>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="8" style="text-align: center; padding: 40px;">
                                    <i class="fas fa-file-alt" style="font-size: 40px; color: #cbd5e1; display: block; margin-bottom: 10px;"></i>
                                    Belum ada bahan rapat
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</body>
</html>