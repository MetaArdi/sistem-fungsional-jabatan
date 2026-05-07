<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kelola SK - Admin Administrasi</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
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
            box-shadow: 0 2px 10px rgba(0,0,0,0.05);
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
            flex-shrink: 0;
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
        }

        .card-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
            flex-wrap: wrap;
            gap: 15px;
        }

        .card-header h2 {
            font-size: 20px;
            font-weight: 600;
            color: #1e293b;
        }

        .btn-add {
            background: linear-gradient(135deg, #1e3c72 0%, #2a5298 100%);
            color: white;
            padding: 8px 18px;
            border-radius: 8px;
            text-decoration: none;
            font-size: 13px;
            font-weight: 500;
            transition: all 0.2s;
            display: inline-flex;
            align-items: center;
            gap: 6px;
        }

        .btn-add:hover {
            transform: translateY(-1px);
            box-shadow: 0 4px 10px rgba(0,0,0,0.1);
        }

        .table-responsive {
            overflow-x: auto;
            -webkit-overflow-scrolling: touch;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            min-width: 950px;
        }

        th, td {
            padding: 12px 15px;
            text-align: left;
            border-bottom: 1px solid #e9ecef;
        }

        th {
            background: #f8fafc;
            font-weight: 600;
            color: #1e293b;
            font-size: 13px;
        }

        td {
            font-size: 13px;
            color: #334155;
        }

        td:first-child, th:first-child {
            padding-left: 20px;
        }

        td:last-child, th:last-child {
            padding-right: 20px;
        }

        /* Buttons */
        .btn-download {
            background: #10b981;
            color: white;
            padding: 6px 14px;
            border-radius: 6px;
            text-decoration: none;
            font-size: 12px;
            font-weight: 500;
            transition: all 0.2s;
            display: inline-flex;
            align-items: center;
            gap: 6px;
            margin-right: 8px;
        }

        .btn-download:hover {
            background: #059669;
            transform: translateY(-1px);
        }

        .btn-edit {
            background: #3b82f6;
            color: white;
            padding: 6px 14px;
            border-radius: 6px;
            text-decoration: none;
            font-size: 12px;
            font-weight: 500;
            transition: all 0.2s;
            display: inline-flex;
            align-items: center;
            gap: 6px;
            margin-right: 8px;
        }

        .btn-edit:hover {
            background: #2563eb;
            transform: translateY(-1px);
        }

        .btn-arsip {
            background: #64748b;
            color: white;
            padding: 6px 14px;
            border-radius: 6px;
            font-size: 12px;
            font-weight: 500;
            border: none;
            cursor: pointer;
            transition: all 0.2s;
            display: inline-flex;
            align-items: center;
            gap: 6px;
            margin-right: 8px;
        }

        .btn-arsip:hover {
            background: #475569;
            transform: translateY(-1px);
        }

        .btn-delete {
            background: #ef4444;
            color: white;
            padding: 6px 14px;
            border-radius: 6px;
            font-size: 12px;
            font-weight: 500;
            border: none;
            cursor: pointer;
            transition: all 0.2s;
            display: inline-flex;
            align-items: center;
            gap: 6px;
        }

        .btn-delete:hover {
            background: #dc2626;
            transform: translateY(-1px);
        }

        .btn-imutasi {
            background: #f59e0b;
            color: white;
            padding: 6px 14px;
            border-radius: 6px;
            font-size: 12px;
            font-weight: 500;
            border: none;
            cursor: pointer;
            transition: all 0.2s;
            display: inline-flex;
            align-items: center;
            gap: 6px;
            margin-right: 8px;
        }

        .btn-imutasi:hover {
            background: #d97706;
            transform: translateY(-1px);
        }

        .btn-bkn {
            background: #10b981;
            color: white;
            padding: 6px 14px;
            border-radius: 6px;
            font-size: 12px;
            font-weight: 500;
            border: none;
            cursor: pointer;
            transition: all 0.2s;
            display: inline-flex;
            align-items: center;
            gap: 6px;
            margin-right: 8px;
        }

        .btn-bkn:hover {
            background: #059669;
            transform: translateY(-1px);
        }

        .alert-success {
            background: #dcfce7;
            color: #166534;
            padding: 12px 16px;
            border-radius: 12px;
            margin-bottom: 20px;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        /* Modal */
        .modal {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0,0,0,0.5);
            justify-content: center;
            align-items: center;
            z-index: 1000;
        }
        .modal.show {
            display: flex;
        }
        .modal-content {
            background: white;
            border-radius: 8px;
            max-width: 450px;
            width: 90%;
            overflow: hidden;
            box-shadow: 0 4px 12px rgba(0,0,0,0.15);
        }
        .modal-header {
            padding: 16px 20px;
            background: #f8fafc;
            border-bottom: 1px solid #e2e8f0;
        }
        .modal-header h3 {
            font-size: 18px;
            font-weight: 600;
            color: #1e293b;
            margin: 0;
        }
        .modal-body {
            padding: 20px;
        }
        .modal-body p {
            font-size: 14px;
            color: #334155;
            margin-bottom: 8px;
            line-height: 1.5;
        }
        .modal-body p:last-child {
            margin-bottom: 0;
        }
        .modal-body strong {
            color: #1e293b;
        }
        .modal-footer {
            padding: 16px 20px;
            background: #f8fafc;
            border-top: 1px solid #e2e8f0;
            text-align: right;
        }
        .modal-btn-confirm {
            background: #dc2626;
            color: white;
            border: none;
            padding: 8px 20px;
            border-radius: 6px;
            font-size: 14px;
            font-weight: 500;
            cursor: pointer;
            margin-left: 10px;
        }
        .modal-btn-confirm:hover {
            background: #b91c1c;
        }
        .modal-btn-cancel {
            background: #f1f5f9;
            color: #334155;
            border: 1px solid #e2e8f0;
            padding: 8px 20px;
            border-radius: 6px;
            font-size: 14px;
            font-weight: 500;
            cursor: pointer;
        }
        .modal-btn-cancel:hover {
            background: #e2e8f0;
        }

        @media (max-width: 768px) {
            .dashboard-wrapper {
                flex-direction: column;
            }
            .sidebar {
                width: 100%;
                border-right: none;
                border-bottom: 1px solid #e9ecef;
            }
            .card-header {
                flex-direction: column;
                align-items: flex-start;
            }
            th, td {
                white-space: normal;
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
                    <h2><i class="fas fa-certificate"></i> Kelola SK</h2>
                    <a href="{{ route('sk.create') }}" class="btn-add">
                        <i class="fas fa-plus"></i> Tambah SK
                    </a>
                </div>

                @if(session('success'))
                    <div class="alert-success">
                        <i class="fas fa-check-circle"></i> {{ session('success') }}
                    </div>
                @endif

                <div class="table-responsive">
                    <table>
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nomor SK</th>
                                <th>Nama Pegawai</th>
                                <th>Tanggal SK</th>
                                <th>File</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($sk as $key => $item)
                            <tr>
                                <td>{{ $key + 1 }}</td>
                                <td>{{ $item->nomor_sk }}</td>
                                <td>{{ $item->usulan->pegawai->nama_lengkap ?? '-' }}</td>
                                <td>{{ \Carbon\Carbon::parse($item->tanggal_sk)->format('d-m-Y') }}</td>
                                <td>
                                    <a href="{{ route('sk.download', $item->id) }}" class="btn-download">
                                        <i class="fas fa-download"></i> Download
                                    </a>
                                 </n>
                                <td style="white-space: nowrap;">
                                    <a href="{{ route('sk.edit', $item->id) }}" class="btn-edit">
                                        <i class="fas fa-edit"></i> Edit
                                    </a>
                                    <form action="{{ route('sk.arsipkan', $item->id) }}" method="POST" style="display:inline;">
                                        @csrf
                                        <button type="submit" class="btn-arsip" onclick="return confirm('Arsipkan SK ini?')">
                                            <i class="fas fa-archive"></i> Arsip
                                        </button>
                                    </form>
                                    <form action="{{ route('sk.destroy', $item->id) }}" method="POST" style="display:inline;" onsubmit="return confirm('Yakin hapus SK ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn-delete">
                                            <i class="fas fa-trash"></i> Hapus
                                        </button>
                                    </form>
                                    <form action="{{ route('sk.kirim_imutasi', $item->id) }}" method="POST" style="display:inline;">
                                        @csrf
                                        <button type="submit" class="btn-imutasi" onclick="return confirm('Kirim data ke I-MUTASI?')">
                                            <i class="fas fa-paper-plane"></i> I-MUTASI
                                        </button>
                                    </form>
                                    <form action="{{ route('sk.kirim_bkn', $item->id) }}" method="POST" style="display:inline;">
                                        @csrf
                                        <button type="submit" class="btn-bkn" onclick="return confirm('Kirim data ke BKN?')">
                                            <i class="fas fa-paper-plane"></i> BKN
                                        </button>
                                    </form>
                                 </n>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="6" style="text-align: center; padding: 40px;">
                                    <i class="fas fa-certificate" style="font-size: 40px; color: #cbd5e1; display: block; margin-bottom: 10px;"></i>
                                    Belum ada SK
                                 </n>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Konfirmasi Hapus -->
    <div id="deleteModal" class="modal">
        <div class="modal-content">
            <div class="modal-header">
                <h3>Konfirmasi Penghapusan</h3>
            </div>
            <div class="modal-body">
                <p>Apakah Anda yakin akan menghapus SK dengan nomor <strong id="deleteItemName"></strong>?</p>
                <p>Data yang telah dihapus tidak dapat dikembalikan.</p>
            </div>
            <div class="modal-footer">
                <form id="deleteForm" method="POST" style="display: inline-block;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="modal-btn-confirm">Hapus</button>
                </form>
                <button type="button" class="modal-btn-cancel" onclick="closeModal()">Batal</button>
            </div>
        </div>
    </div>

    <script>
        function showDeleteModal(id, name, type) {
            document.getElementById('deleteItemName').innerText = name;
            const form = document.getElementById('deleteForm');
            if (type === 'sk') {
                form.action = '/admin_administrasi/sk/' + id;
            }
            document.getElementById('deleteModal').classList.add('show');
        }
        
        function closeModal() {
            document.getElementById('deleteModal').classList.remove('show');
        }
        
        window.onclick = function(event) {
            const modal = document.getElementById('deleteModal');
            if (event.target == modal) {
                modal.classList.remove('show');
            }
        }
    </script>
</body>
</html>