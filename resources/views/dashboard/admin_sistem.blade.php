<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Admin Sistem</title>
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
            position: sticky;
            top: 0;
            z-index: 100;
        }
        .logo-area { display: flex; align-items: center; gap: 12px; }
        .logo-img { width: 42px; height: 42px; object-fit: cover; border-radius: 10px; }
        .logo-text { font-size: 18px; font-weight: 700; background: linear-gradient(135deg, #1e3c72 0%, #2a5298 100%); -webkit-background-clip: text; -webkit-text-fill-color: transparent; }
        .user-info { display: flex; align-items: center; gap: 20px; }
        .user-name { font-weight: 500; color: #333; }
        .logout-btn { background: #ef4444; color: white; text-decoration: none; padding: 8px 18px; border-radius: 8px; font-size: 13px; font-weight: 500; transition: all 0.2s; }
        .logout-btn:hover { background: #dc2626; transform: translateY(-1px); }
        
        .dashboard-wrapper { display: flex; }
        .sidebar {
            width: 280px;
            background: white;
            min-height: calc(100vh - 66px);
            border-right: 1px solid #e9ecef;
            padding: 25px 0;
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
            transition: all 0.2s;
        }
        .sidebar-menu li a i { width: 22px; font-size: 16px; }
        .sidebar-menu li a:hover { background: #f0f4f8; color: #2a5298; }
        .sidebar-menu li.active a { background: linear-gradient(135deg, #1e3c72 0%, #2a5298 100%); color: white; border-radius: 0 20px 20px 0; }
        
        .main-content { flex: 1; padding: 30px; }
        
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
        .welcome-text h1 { font-size: 24px; font-weight: 700; margin-bottom: 8px; }
        .welcome-text p { opacity: 0.9; font-size: 14px; }
        .role-badge { background: rgba(255,255,255,0.2); padding: 6px 16px; border-radius: 30px; font-size: 12px; font-weight: 500; display: inline-block; margin-top: 12px; }
        .welcome-icon i { font-size: 70px; opacity: 0.3; }
        
        .stats-grid { display: grid; grid-template-columns: repeat(4, 1fr); gap: 24px; margin-bottom: 30px; }
        .stat-card {
            background: white;
            border-radius: 20px;
            padding: 20px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            transition: all 0.3s;
            box-shadow: 0 2px 8px rgba(0,0,0,0.04);
        }
        .stat-card:hover { transform: translateY(-3px); box-shadow: 0 8px 20px rgba(0,0,0,0.08); }
        .stat-info h3 { font-size: 28px; font-weight: 800; color: #1e293b; }
        .stat-info p { font-size: 13px; color: #64748b; margin-top: 5px; }
        .stat-icon { width: 50px; height: 50px; background: #eef2ff; border-radius: 15px; display: flex; align-items: center; justify-content: center; }
        .stat-icon i { font-size: 24px; color: #2a5298; }
        
        .recent-card {
            background: white;
            border-radius: 20px;
            padding: 20px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.04);
        }
        .recent-card h3 { font-size: 16px; font-weight: 600; margin-bottom: 15px; color: #1e293b; }
        .activity-list { list-style: none; }
        .activity-list li {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 12px 0;
            border-bottom: 1px solid #f0f0f0;
        }
        .activity-list li:last-child { border-bottom: none; }
        .activity-icon { width: 32px; height: 32px; background: #f0f4f8; border-radius: 10px; display: flex; align-items: center; justify-content: center; }
        .activity-icon i { font-size: 14px; color: #2a5298; }
        .activity-text { flex: 1; font-size: 13px; color: #334155; }
        .activity-time { font-size: 11px; color: #94a3b8; }
        
        @media (max-width: 1024px) { .stats-grid { grid-template-columns: repeat(2, 1fr); } }
        @media (max-width: 768px) { .dashboard-wrapper { flex-direction: column; } .sidebar { width: 100%; } .stats-grid { grid-template-columns: 1fr; } .welcome-card { flex-direction: column; text-align: center; gap: 20px; } }
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
                <li class="active"><a href="{{ url('/dashboard/admin_sistem') }}"><i class="fas fa-chart-line"></i> Dashboard</a></li>
                <li><a href="{{ url('/opd') }}"><i class="fas fa-building"></i> Kelola OPD</a></li>
                <li><a href="{{ url('/user') }}"><i class="fas fa-users"></i> Kelola User</a></li>
                <li><a href="{{ url('/besetting-jf') }}"><i class="fas fa-cogs"></i> Besetting JF</a></li>
            </ul>
        </div>

        <div class="main-content">
            <div class="welcome-card">
                <div class="welcome-text">
                    <h1>Selamat Datang, {{ session('user')->username }}!</h1>
                    <p>Anda login sebagai Admin Sistem. Kelola seluruh data dan konfigurasi sistem di sini.</p>
                    <span class="role-badge"><i class="fas fa-shield-alt"></i> Admin Sistem</span>
                </div>
                <div class="welcome-icon">
                    <i class="fas fa-user-cog"></i>
                </div>
            </div>

            <div class="stats-grid">
                <div class="stat-card">
                    <div class="stat-info">
                        <h3>{{ \App\Models\OPD::count() }}</h3>
                        <p>OPD Terdaftar</p>
                    </div>
                    <div class="stat-icon"><i class="fas fa-building"></i></div>
                </div>
                <div class="stat-card">
                    <div class="stat-info">
                        <h3>{{ \App\Models\User::count() }}</h3>
                        <p>User Aktif</p>
                    </div>
                    <div class="stat-icon"><i class="fas fa-users"></i></div>
                </div>
                <div class="stat-card">
                    <div class="stat-info">
                        <h3>{{ \App\Models\Pegawai::count() }}</h3>
                        <p>Pegawai</p>
                    </div>
                    <div class="stat-icon"><i class="fas fa-id-card"></i></div>
                </div>
                <div class="stat-card">
                    <div class="stat-info">
                        <h3>{{ \App\Models\Usulan::count() }}</h3>
                        <p>Usulan</p>
                    </div>
                    <div class="stat-icon"><i class="fas fa-file-alt"></i></div>
                </div>
            </div>

            <div class="recent-card">
                <h3><i class="fas fa-clock"></i> Aktivitas Terbaru</h3>
                <ul class="activity-list">
                    @php
                        $aktivitas = \App\Models\LogIntegrasi::with('user')
                            ->orderBy('created_at', 'desc')
                            ->limit(5)
                            ->get();
                    @endphp
                    
                    @forelse($aktivitas as $log)
                    <li>
                        <div class="activity-icon">
                            @if($log->status == 'berhasil')
                                <i class="fas fa-check-circle" style="color:#10b981;"></i>
                            @else
                                <i class="fas fa-times-circle" style="color:#ef4444;"></i>
                            @endif
                        </div>
                        <div class="activity-text">
                            {{ $log->user->username ?? 'Sistem' }} - {{ $log->aksi }}
                            @if($log->response)
                                <span style="font-size: 10px; color: #64748b;">({{ $log->response }})</span>
                            @endif
                        </div>
                        <div class="activity-time">{{ $log->created_at->diffForHumans() }}</div>
                    </li>
                    @empty
                    <li>
                        <div class="activity-icon"><i class="fas fa-info-circle"></i></div>
                        <div class="activity-text">Belum ada aktivitas terbaru.</div>
                        <div class="activity-time"></div>
                    </li>
                    @endforelse
                </ul>
            </div>
        </div>
    </div>
</body>
</html>