<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Admin Administrasi</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap"
        rel="stylesheet">
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
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
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
        }

        .welcome-card {
            background: linear-gradient(135deg, #1e3c72 0%, #2a5298 100%);
            border-radius: 20px;
            padding: 30px;
            margin-bottom: 30px;
            color: white;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .welcome-text h1 {
            font-size: 24px;
            font-weight: 700;
            margin-bottom: 8px;
        }

        .welcome-text p {
            opacity: 0.9;
            font-size: 14px;
        }

        .role-badge {
            background: rgba(255, 255, 255, 0.2);
            padding: 6px 16px;
            border-radius: 30px;
            font-size: 12px;
            font-weight: 500;
            display: inline-block;
            margin-top: 12px;
        }

        .welcome-icon i {
            font-size: 70px;
            opacity: 0.3;
        }

        .stats-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 24px;
            margin-bottom: 30px;
        }

        .stat-card {
            background: white;
            border-radius: 20px;
            padding: 20px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            transition: all 0.3s;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.04);
        }

        .stat-card:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.08);
        }

        .stat-info h3 {
            font-size: 28px;
            font-weight: 800;
            color: #1e293b;
        }

        .stat-info p {
            font-size: 13px;
            color: #64748b;
            margin-top: 5px;
        }

        .stat-icon {
            width: 50px;
            height: 50px;
            background: #eef2ff;
            border-radius: 15px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .stat-icon i {
            font-size: 24px;
            color: #2a5298;
        }

        .recent-card {
            background: white;
            border-radius: 20px;
            padding: 20px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.04);
        }

        .recent-card h3 {
            font-size: 16px;
            font-weight: 600;
            margin-bottom: 15px;
            color: #1e293b;
        }

        .activity-list {
            list-style: none;
        }

        .activity-list li {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 12px 0;
            border-bottom: 1px solid #f0f0f0;
        }

        .activity-list li:last-child {
            border-bottom: none;
        }

        .activity-icon {
            width: 32px;
            height: 32px;
            background: #f0f4f8;
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .activity-icon i {
            font-size: 14px;
            color: #2a5298;
        }

        .activity-text {
            flex: 1;
            font-size: 13px;
            color: #334155;
        }

        .activity-time {
            font-size: 11px;
            color: #94a3b8;
        }

        @media (max-width: 1024px) {
            .stats-grid {
                grid-template-columns: repeat(2, 1fr);
            }
        }

        @media (max-width: 768px) {
            .dashboard-wrapper {
                flex-direction: column;
            }

            .sidebar {
                width: 100%;
            }

            .stats-grid {
                grid-template-columns: 1fr;
            }

            .welcome-card {
                flex-direction: column;
                text-align: center;
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
            <a href="{{ route('logout') }}" class="logout-btn"><i class="fas fa-sign-out-alt"></i> Logout</a>
        </div>
    </div>

    <div class="dashboard-wrapper">
        <div class="sidebar">
            <ul class="sidebar-menu">
                <li class="active"><a href="{{ url('/dashboard/admin_administrasi') }}"><i
                            class="fas fa-chart-line"></i> Dashboard</a></li>
                <li><a href="{{ url('/bahan-rapat/admin') }}"><i class="fas fa-file-alt"></i> Bahan Rapat</a></li>
                <li><a href="{{ url('/admin_administrasi/sk') }}"><i class="fas fa-certificate"></i> Kelola SK</a></li>
                <li><a href="{{ url('/admin_administrasi/sk/arsip') }}"><i class="fas fa-archive"></i> Arsip SK</a></li>
                <li><a href="{{ url('/admin_administrasi/riwayat-usulan') }}"><i class="fas fa-history"></i> Riwayat
                        Usulan</a></li>
                <li><a href="{{ url('/laporan/rekap-usulan') }}"><i class="fas fa-chart-bar"></i> Laporan Rekap
                        Usulan</a></li>
                <li><a href="{{ url('/admin_administrasi/log-integrasi') }}"><i class="fas fa-exchange-alt"></i> Log
                        Integrasi</a></li>
            </ul>
        </div>

        <div class="main-content">
            <div class="welcome-card">
                <div class="welcome-text">
                    <h1>Selamat Datang, {{ session('user')->username }}!</h1>
                    <p>Anda login sebagai Admin Administrasi. Setujui bahan rapat dan terbitkan SK kenaikan jabatan.</p>
                    <span class="role-badge"><i class="fas fa-stamp"></i> Admin Administrasi</span>
                </div>
                <div class="welcome-icon">
                    <i class="fas fa-file-signature"></i>
                </div>
            </div>

            <div class="stats-grid">
                <div class="stat-card">
                    <div class="stat-info">
                        <h3>{{ \App\Models\BahanRapat::where('status_bahan', 'menunggu_persetujuan')->count() }}</h3>
                        <p>Bahan Rapat Menunggu</p>
                    </div>
                    <div class="stat-icon"><i class="fas fa-clock"></i></div>
                </div>
                <div class="stat-card">
                    <div class="stat-info">
                        <h3>{{ \App\Models\BahanRapat::where('status_bahan', 'disetujui')->count() }}</h3>
                        <p>Bahan Rapat Disetujui</p>
                    </div>
                    <div class="stat-icon"><i class="fas fa-check-circle"></i></div>
                </div>
                <div class="stat-card">
                    <div class="stat-info">
                        <h3>{{ \App\Models\SK::where('status', 'aktif')->count() }}</h3>
                        <p>SK Aktif</p>
                    </div>
                    <div class="stat-icon"><i class="fas fa-file-pdf"></i></div>
                </div>
                <div class="stat-card">
                    <div class="stat-info">
                        <h3>{{ \App\Models\SK::where('status', 'arsip')->count() }}</h3>
                        <p>SK Arsip</p>
                    </div>
                    <div class="stat-icon"><i class="fas fa-archive"></i></div>
                </div>
            </div>

            <div class="recent-card">
                <h3><i class="fas fa-clock"></i> Bahan Rapat Menunggu Persetujuan</h3>
                <ul class="activity-list">
                    @php
                        $bahanRapat = \App\Models\BahanRapat::with('usulan.pegawai')
                            ->where('status_bahan', 'menunggu_persetujuan')
                            ->orderBy('created_at', 'desc')
                            ->limit(3)
                            ->get();
                    @endphp

                    @forelse($bahanRapat as $item)
                        <li>
                            <div class="activity-icon"><i class="fas fa-file-alt"></i></div>
                            <div class="activity-text">
                                {{ $item->nomor_bahan }} -
                                @foreach($item->usulan as $usul)
                                    {{ $usul->pegawai->nama_lengkap ?? '-' }}{{ !$loop->last ? ', ' : '' }}
                                @endforeach
                                (@foreach($item->usulan as $usul)
                                    {{ $usul->jabatan_baru ?? $usul->unit_kerja_tujuan ?? 'Pemberhentian' }}{{ !$loop->last ? ', ' : '' }}
                                @endforeach)
                            </div>
                            <div class="activity-time">{{ $item->created_at->format('d-m-Y') }}</div>
                        </li>
                    @empty
                        <li>
                            <div class="activity-icon"><i class="fas fa-info-circle"></i></div>
                            <div class="activity-text">Tidak ada bahan rapat yang menunggu persetujuan</div>
                            <div class="activity-time"></div>
                        </li>
                    @endforelse
                </ul>
            </div>
        </div>
    </div>
</body>

</html>