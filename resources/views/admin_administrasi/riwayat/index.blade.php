<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Riwayat Usulan - Admin Administrasi</title>
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
        .status-diverifikasi { background: #dbeafe; color: #1e40af; }
        .status-disetujui { background: #dcfce7; color: #166534; }
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
                <li><a href="{{ url('/dashboard/admin_administrasi') }}"><i class="fas fa-chart-line"></i> Dashboard</a></li>
                <li><a href="{{ url('/bahan-rapat/admin') }}"><i class="fas fa-file-alt"></i> Bahan Rapat</a></li>
                <li><a href="{{ url('/admin_administrasi/sk') }}"><i class="fas fa-certificate"></i> Kelola SK</a></li>
                <li><a href="{{ url('/admin_administrasi/sk/arsip') }}"><i class="fas fa-archive"></i> Arsip SK</a></li>
                <li class="active"><a href="{{ url('/admin_administrasi/riwayat-usulan') }}"><i class="fas fa-history"></i> Riwayat Usulan</a></li>
                <li><a href="{{ url('/admin_administrasi/log-integrasi') }}"><i class="fas fa-exchange-alt"></i> Log Integrasi</a></li>
            </ul>
        </div>

        <div class="main-content">
            <div class="card">
                <div class="card-header">
                    <h2><i class="fas fa-history"></i> Riwayat Usulan</h2>
                </div>

                <div class="table-responsive">
                    <table>
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Tanggal & Waktu</th>
                                <th>Nama Pegawai</th>
                                <th>NIP</th>
                                <th>Status</th>
                                <th>Keterangan</th>
                                <th>User</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($riwayat as $key => $item)
                            <tr>
                                <td>{{ $key + 1 }}</td>
                                <td>{{ $item->created_at->format('d-m-Y H:i:s') }}</td>
                                <td>{{ $item->usulan->pegawai->nama_lengkap ?? '-' }}</td>
                                <td>{{ $item->usulan->pegawai->nip ?? '-' }}</td>
                                <td>
                                    @if($item->status == 'menunggu_verifikasi')
                                        <span class="status-badge status-menunggu">Menunggu Verifikasi</span>
                                    @elseif($item->status == 'sedang_diverifikasi')
                                        <span class="status-badge status-diverifikasi">Sedang Diverifikasi</span>
                                    @elseif($item->status == 'menunggu_persetujuan')
                                        <span class="status-badge status-menunggu">Menunggu Persetujuan</span>
                                    @elseif($item->status == 'sk_diterbitkan')
                                        <span class="status-badge status-selesai">SK Diterbitkan</span>
                                    @elseif($item->status == 'ditolak_verifikator')
                                        <span class="status-badge status-ditolak">Ditolak Verifikator</span>
                                    @elseif($item->status == 'ditolak_administrasi')
                                        <span class="status-badge status-ditolak">Ditolak Administrasi</span>
                                    @else
                                        <span class="status-badge">{{ $item->status }}</span>
                                    @endif
                                 </n>
                                <td>{{ $item->keterangan ?? '-' }}</td>
                                <td>{{ $item->user->username ?? '-' }}</td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="7" style="text-align: center; padding: 40px;">
                                    <i class="fas fa-history" style="font-size: 40px; color: #cbd5e1; display: block; margin-bottom: 10px;"></i>
                                    Belum ada riwayat usulan
                                 </n>
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