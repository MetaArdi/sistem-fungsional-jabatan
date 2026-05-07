<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Besetting JF - Admin Sistem</title>
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

        .alert-error {
            background: #fee2e2;
            color: #991b1b;
            padding: 12px 16px;
            border-radius: 10px;
            margin-bottom: 20px;
            font-size: 13px;
            line-height: 1.6;
        }

        .form-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 18px;
        }

        .form-group {
            margin-bottom: 18px;
        }

        .form-group.full {
            grid-column: 1 / -1;
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
            padding: 11px 12px;
            border: 1px solid #e2e8f0;
            border-radius: 10px;
            font-family: 'Inter', sans-serif;
            font-size: 14px;
            transition: all 0.2s;
            background: #fff;
        }

        input:focus, select:focus {
            outline: none;
            border-color: #2a5298;
            box-shadow: 0 0 0 3px rgba(42,82,152,0.1);
        }

        .form-actions {
            margin-top: 25px;
            display: flex;
            gap: 12px;
            border-top: 1px solid #e9ecef;
            padding-top: 20px;
            flex-wrap: wrap;
        }

        .btn-update {
            background: #f59e0b;
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

        @media (max-width: 768px) {
            .dashboard-wrapper { flex-direction: column; }
            .sidebar { width: 100%; }
            .form-grid { grid-template-columns: 1fr; }
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
                    <h2><i class="fas fa-edit"></i> Edit Besetting JF</h2>
                </div>

                @if($errors->any())
                    <div class="alert-error">
                        <i class="fas fa-exclamation-circle"></i>
                        @foreach($errors->all() as $error)
                            {{ $error }}<br>
                        @endforeach
                    </div>
                @endif

                <form action="{{ route('besetting-jf.update', $besetting->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="form-grid">
                        <div class="form-group full">
                            <label>OPD</label>
                            <select name="opd_id" required>
                                <option value="">Pilih OPD</option>
                                @foreach($opd as $item)
                                    <option value="{{ $item->id_opd }}" {{ old('opd_id', $besetting->opd_id) == $item->id_opd ? 'selected' : '' }}>
                                        {{ $item->nama_opd }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group full">
                            <label>Jabatan Fungsional</label>
                            <input type="text" name="jabatan_fungsional" value="{{ old('jabatan_fungsional', $besetting->jabatan_fungsional) }}" required>
                        </div>

                        <div class="form-group">
                            <label>Jenjang</label>
                            <select name="jenjang" required>
                                <option value="">Pilih Jenjang</option>
                                <option value="Pertama" {{ old('jenjang', $besetting->jenjang) == 'Pertama' ? 'selected' : '' }}>Pertama</option>
                                <option value="Muda" {{ old('jenjang', $besetting->jenjang) == 'Muda' ? 'selected' : '' }}>Muda</option>
                                <option value="Madya" {{ old('jenjang', $besetting->jenjang) == 'Madya' ? 'selected' : '' }}>Madya</option>
                                <option value="Utama" {{ old('jenjang', $besetting->jenjang) == 'Utama' ? 'selected' : '' }}>Utama</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label>Tahun</label>
                            <input type="number" name="tahun" value="{{ old('tahun', $besetting->tahun) }}" required>
                        </div>

                        <div class="form-group">
                            <label>Kebutuhan</label>
                            <input type="number" name="kebutuhan" value="{{ old('kebutuhan', $besetting->kebutuhan) }}" required>
                        </div>

                        <div class="form-group">
                            <label>Ketersediaan</label>
                            <input type="number" name="ketersediaan" value="{{ old('ketersediaan', $besetting->ketersediaan) }}" required>
                        </div>
                    </div>

                    <div class="form-actions">
                        <button type="submit" class="btn-update">
                            <i class="fas fa-save"></i> Update
                        </button>
                        <a href="{{ route('besetting-jf.index') }}" class="btn-back">
                            <i class="fas fa-arrow-left"></i> Kembali
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>
</html>