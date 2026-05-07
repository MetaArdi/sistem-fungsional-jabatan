<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Besetting JF - Admin Sistem</title>
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

        .user-info { display: flex; align-items: center; gap: 20px; }
        .user-name { font-weight: 500; color: #333; }
        .logout-btn {
            background: #ef4444;
            color: white;
            text-decoration: none;
            padding: 8px 18px;
            border-radius: 8px;
            font-size: 13px;
            font-weight: 500;
        }

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

        .detail-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 18px;
        }

        .detail-group {
            margin-bottom: 18px;
        }

        .detail-group.full {
            grid-column: 1 / -1;
        }

        .detail-group label {
            font-weight: 600;
            color: #1e293b;
            font-size: 13px;
            display: block;
            margin-bottom: 6px;
        }

        .detail-group p {
            color: #334155;
            font-size: 14px;
            background: #f8fafc;
            padding: 11px 12px;
            border-radius: 10px;
            min-height: 44px;
            display: flex;
            align-items: center;
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
            margin-top: 20px;
        }

        @media (max-width: 768px) {
            .dashboard-wrapper { flex-direction: column; }
            .sidebar { width: 100%; }
            .detail-grid { grid-template-columns: 1fr; }
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
                <li><a href="{{ url('/dashboard/admin_sistem') }}"><i class="fas fa-chart-line"></i> Dashboard</a></li>
                <li><a href="{{ url('/opd') }}"><i class="fas fa-building"></i> Kelola OPD</a></li>
                <li><a href="{{ url('/user') }}"><i class="fas fa-users"></i> Kelola User</a></li>
                <li class="active"><a href="{{ url('/besetting-jf') }}"><i class="fas fa-cogs"></i> Besetting JF</a></li>
            </ul>
        </div>

        <div class="main-content">
            <div class="card">
                <div class="card-header">
                    <h2><i class="fas fa-cogs"></i> Detail Besetting JF</h2>
                </div>

                <div class="detail-grid">
                    <div class="detail-group full">
                        <label>OPD</label>
                        <p>{{ $besetting->opd->nama_opd ?? '-' }}</p>
                    </div>

                    <div class="detail-group full">
                        <label>Jabatan Fungsional</label>
                        <p>{{ $besetting->jabatan_fungsional }}</p>
                    </div>

                    <div class="detail-group">
                        <label>Jenjang</label>
                        <p>{{ $besetting->jenjang }}</p>
                    </div>

                    <div class="detail-group">
                        <label>Tahun</label>
                        <p>{{ $besetting->tahun }}</p>
                    </div>

                    <div class="detail-group">
                        <label>Kebutuhan</label>
                        <p>{{ $besetting->kebutuhan }}</p>
                    </div>

                    <div class="detail-group">
                        <label>Ketersediaan</label>
                        <p>{{ $besetting->ketersediaan }}</p>
                    </div>

                    <div class="detail-group">
                        <label>Dibuat pada</label>
                        <p>{{ $besetting->created_at ? $besetting->created_at->format('d-m-Y H:i:s') : '-' }}</p>
                    </div>

                    <div class="detail-group">
                        <label>Terakhir diupdate</label>
                        <p>{{ $besetting->updated_at ? $besetting->updated_at->format('d-m-Y H:i:s') : '-' }}</p>
                    </div>
                </div>

                <a href="{{ route('besetting-jf.index') }}" class="btn-back">
                    <i class="fas fa-arrow-left"></i> Kembali
                </a>
            </div>
        </div>
    </div>
</body>
</html>