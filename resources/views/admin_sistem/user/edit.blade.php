<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit User - Admin Sistem</title>
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
            transition: all 0.2s;
        }
        .logout-btn:hover { background: #dc2626; transform: translateY(-1px); }

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
            transition: all 0.2s;
        }
        .sidebar-menu li a i { width: 22px; font-size: 16px; text-align: center; }
        .sidebar-menu li a:hover { background: #f0f4f8; color: #2a5298; }
        .sidebar-menu li.active a {
            background: linear-gradient(135deg, #1e3c72 0%, #2a5298 100%);
            color: white;
            border-radius: 0 20px 20px 0;
        }

        .main-content { flex: 1; padding: 30px; min-width: 0; }
        .card {
            background: white;
            border-radius: 20px;
            padding: 25px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.04);
            max-width: 600px;
        }
        .card-header { margin-bottom: 20px; border-bottom: 1px solid #e9ecef; padding-bottom: 15px; }
        .card-header h2 { font-size: 20px; font-weight: 600; color: #1e293b; }

        .form-group { margin-bottom: 20px; }
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
        small { display: block; color: #666; font-size: 11px; margin-top: 4px; }

        .form-actions {
            margin-top: 25px;
            display: flex;
            gap: 12px;
            border-top: 1px solid #e9ecef;
            padding-top: 20px;
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
            transition: all 0.2s;
        }
        .btn-update:hover { transform: translateY(-1px); box-shadow: 0 4px 10px rgba(0,0,0,0.1); }
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
        .btn-back:hover { background: #475569; transform: translateY(-1px); }

        .alert-error {
            background: #fee2e2;
            color: #991b1b;
            padding: 12px 16px;
            border-radius: 10px;
            margin-bottom: 20px;
            font-size: 13px;
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
                <li><a href="{{ url('/dashboard/admin_sistem') }}"><i class="fas fa-chart-line"></i> Dashboard</a></li>
                <li><a href="{{ url('/opd') }}"><i class="fas fa-building"></i> Kelola OPD</a></li>
                <li class="active"><a href="{{ url('/user') }}"><i class="fas fa-users"></i> Kelola User</a></li>
                <li><a href="{{ url('/besetting-jf') }}"><i class="fas fa-cogs"></i> Besetting JF</a></li>
            </ul>
        </div>

        <div class="main-content">
            <div class="card">
                <div class="card-header">
                    <h2><i class="fas fa-edit"></i> Edit User</h2>
                </div>

                @if($errors->any())
                    <div class="alert-error">
                        <i class="fas fa-exclamation-circle"></i>
                        @foreach($errors->all() as $error)
                            {{ $error }}<br>
                        @endforeach
                    </div>
                @endif

                <form method="POST" action="{{ route('user.update', $user->id) }}">
                    @csrf
                    @method('PUT')

                    <div class="form-group">
                        <label>Username <span style="color:red;">*</span></label>
                        <input type="text" name="username" value="{{ old('username', $user->username) }}" required>
                    </div>

                    <div class="form-group">
                        <label>Password</label>
                        <input type="password" name="password">
                        <small>Kosongkan jika tidak ingin mengubah password</small>
                    </div>

                    <div class="form-group">
                        <label>Role <span style="color:red;">*</span></label>
                        <select name="role" id="role" required onchange="toggleOpdField()">
                            <option value="">Pilih Role</option>
                            <option value="admin_sistem" {{ old('role', $user->role) == 'admin_sistem' ? 'selected' : '' }}>Admin Sistem</option>
                            <option value="admin_opd" {{ old('role', $user->role) == 'admin_opd' ? 'selected' : '' }}>Admin OPD</option>
                            <option value="verifikator" {{ old('role', $user->role) == 'verifikator' ? 'selected' : '' }}>Verifikator</option>
                            <option value="admin_administrasi" {{ old('role', $user->role) == 'admin_administrasi' ? 'selected' : '' }}>Admin Administrasi</option>
                        </select>
                    </div>

                    <div class="form-group" id="opdField" style="display: none;">
                        <label>OPD <span style="color:red;">*</span></label>
                        <select name="id_opd" id="id_opd">
                            <option value="">Pilih OPD</option>
                            @foreach($opd as $item)
                                <option value="{{ $item->id_opd }}" {{ old('id_opd', $user->id_opd) == $item->id_opd ? 'selected' : '' }}>
                                    {{ $item->nama_opd }}
                                </option>
                            @endforeach
                        </select>
                        <small>Wajib dipilih jika role adalah Admin OPD</small>
                    </div>

                    <div class="form-actions">
                        <button type="submit" class="btn-update">
                            <i class="fas fa-save"></i> Update
                        </button>
                        <a href="{{ route('user.index') }}" class="btn-back">
                            <i class="fas fa-arrow-left"></i> Kembali
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        function toggleOpdField() {
            const role = document.getElementById('role').value;
            const opdField = document.getElementById('opdField');
            const idOpd = document.getElementById('id_opd');

            if (role === 'admin_opd') {
                opdField.style.display = 'block';
                idOpd.setAttribute('required', 'required');
            } else {
                opdField.style.display = 'none';
                idOpd.removeAttribute('required');
                idOpd.value = '';
            }
        }

        window.onload = toggleOpdField;
    </script>
</body>
</html>