<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit SK - Admin Administrasi</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="icon" type="image/png" href="{{ asset('images/logobkpsdm.png') }}">
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: 'Inter', sans-serif; background: #f5f7fb; }
        .navbar { background: white; box-shadow: 0 2px 10px rgba(0,0,0,0.05); padding: 12px 30px; display: flex; justify-content: space-between; align-items: center; }
        .logo-img { width: 42px; border-radius: 10px; }
        .logo-text { font-size: 18px; font-weight: 700; background: linear-gradient(135deg, #1e3c72 0%, #2a5298 100%); -webkit-background-clip: text; -webkit-text-fill-color: transparent; }
        .logout-btn { background: #ef4444; color: white; text-decoration: none; padding: 8px 18px; border-radius: 8px; }
        .dashboard-wrapper { display: flex; }
        .sidebar { width: 280px; background: white; min-height: calc(100vh - 66px); border-right: 1px solid #e9ecef; padding: 25px 0; }
        .sidebar-menu li a { display: flex; align-items: center; gap: 12px; padding: 12px 24px; color: #4a5568; text-decoration: none; }
        .sidebar-menu li.active a { background: linear-gradient(135deg, #1e3c72 0%, #2a5298 100%); color: white; border-radius: 0 20px 20px 0; }
        .main-content { flex: 1; padding: 30px; }
        .card { background: white; border-radius: 20px; padding: 25px; max-width: 600px; }
        .card-header { margin-bottom: 20px; border-bottom: 1px solid #e9ecef; padding-bottom: 15px; }
        .form-group { margin-bottom: 20px; }
        label { font-weight: 600; font-size: 13px; display: block; margin-bottom: 6px; }
        input, select, textarea { width: 100%; padding: 10px; border: 1px solid #ccc; border-radius: 8px; }
        .current-file { background: #f0f4f8; padding: 8px; border-radius: 6px; font-size: 12px; margin-top: 5px; }
        .btn-submit { background: #f59e0b; color: white; padding: 10px 20px; border: none; border-radius: 8px; cursor: pointer; }
        .btn-back { background: #64748b; color: white; padding: 10px 20px; border-radius: 8px; text-decoration: none; }
        .form-actions { display: flex; gap: 10px; margin-top: 20px; }
    </style>
</head>
<body>
    <div class="navbar">
        <div class="logo-area"><img src="{{ asset('images/logobkpsdm.jpg') }}" class="logo-img"><span class="logo-text">Sistem Jabatan Fungsional BKPSDM Kudus</span></div>
        <a href="/logout" class="logout-btn"><i class="fas fa-sign-out-alt"></i> Logout</a>
    </div>
    <div class="dashboard-wrapper">
        <div class="sidebar">
            <ul class="sidebar-menu">
                <li><a href="{{ url('/dashboard/admin_administrasi') }}"><i class="fas fa-chart-line"></i> Dashboard</a></li>
                <li><a href="{{ url('/bahan-rapat/admin') }}"><i class="fas fa-file-alt"></i> Bahan Rapat</a></li>
                <li class="active"><a href="{{ url('/admin_administrasi/sk') }}"><i class="fas fa-certificate"></i> Kelola SK</a></li>
            </ul>
        </div>
        <div class="main-content">
            <div class="card">
                <div class="card-header"><h2>Edit SK</h2></div>
                <form action="{{ route('sk.update', $sk->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf @method('PUT')
                    <div class="form-group">
                        <label>Pilih Usulan</label>
                        <select name="id_usulan" required>
                            @foreach($usulan as $item)
                                <option value="{{ $item->id }}" {{ $sk->id_usulan == $item->id ? 'selected' : '' }}>{{ $item->pegawai->nama_lengkap }} - {{ $item->jenis_usulan }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Nomor SK</label>
                        <input type="text" name="nomor_sk" value="{{ $sk->nomor_sk }}" required>
                    </div>
                    <div class="form-group">
                        <label>Tanggal SK</label>
                        <input type="date" name="tanggal_sk" value="{{ $sk->tanggal_sk }}" required>
                    </div>
                    <div class="form-group">
                        <label>File SK (PDF)</label>
                        <input type="file" name="file_sk" accept=".pdf">
                        <div class="current-file">File saat ini: <a href="{{ route('sk.download', $sk->id) }}">{{ basename($sk->file_sk) }}</a></div>
                    </div>
                    <div class="form-group">
                        <label>Keterangan</label>
                        <textarea name="keterangan" rows="3">{{ $sk->keterangan }}</textarea>
                    </div>
                    <div class="form-actions">
                        <button type="submit" class="btn-submit"><i class="fas fa-save"></i> Update</button>
                        <a href="{{ route('sk.index') }}" class="btn-back"><i class="fas fa-arrow-left"></i> Kembali</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>
</html>