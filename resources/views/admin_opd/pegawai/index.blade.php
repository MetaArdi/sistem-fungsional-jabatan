<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Induk Pegawai - Admin OPD</title>
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
            min-width: 800px;
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
        .btn-view {
            background: #22c55e;
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

        .btn-view:hover {
            background: #16a34a;
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
                <li><a href="{{ url('/dashboard/admin_opd') }}"><i class="fas fa-chart-line"></i> Dashboard</a></li>
                <li class="active"><a href="{{ url('/pegawai') }}"><i class="fas fa-address-card"></i> Data Induk Pegawai</a></li>
                <li><a href="{{ url('/usulan') }}"><i class="fas fa-file-alt"></i> Data Usulan</a></li>
            </ul>
        </div>

        <div class="main-content">
            <div class="card">
                <div class="card-header">
                    <h2><i class="fas fa-address-card"></i> Data Induk Pegawai</h2>
                    <a href="{{ route('pegawai.create') }}" class="btn-add">
                        <i class="fas fa-plus"></i> Tambah Pegawai
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
                                <th>NIP</th>
                                <th>Nama</th>
                                <th>No. Sertifikat</th>
                                <th>Jabatan Saat Ini</th>
                                <th>Pangkat/Gol</th>
                                <th>Unit Kerja</th>
                                <th>Status</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($pegawai as $key => $item)
                            <tr>
                                <td>{{ $key + 1 }}</td>
                                <td>{{ $item->nip }}</td>
                                <td>{{ $item->nama_lengkap }}</td>
                                <td>{{ $item->no_sertifikat ?? '-' }}</td>
                                <td>{{ $item->jabatan_saat_ini }}</td>
                                <td>{{ $item->pangkat }} / {{ $item->golongan }}</td>
                                <td>{{ $item->unit_kerja }}</td>
                                <td>
                                    @if($item->status_aktif == 'aktif')
                                        <span style="background: #dcfce7; color: #166534; padding: 4px 8px; border-radius: 4px; font-size: 12px; font-weight: 500;">Aktif</span>
                                    @else
                                        <span style="background: #fee2e2; color: #991b1b; padding: 4px 8px; border-radius: 4px; font-size: 12px; font-weight: 500;">Nonaktif</span>
                                    @endif
                                </td>
                                <td style="white-space: nowrap;">
                                    <a href="{{ route('pegawai.show', $item->nip) }}" class="btn-view">
                                        <i class="fas fa-eye"></i> View
                                    </a>
                                    <a href="{{ route('pegawai.edit', $item->nip) }}" class="btn-edit">
                                        <i class="fas fa-edit"></i> Edit
                                    </a>
                                    @if($item->status_aktif == 'aktif')
                                    <form action="{{ route('pegawai.nonaktifkan', $item->nip) }}" method="POST" style="display:inline-block;" onsubmit="return confirm('Yakin ingin menonaktifkan pegawai ini? Semua usulan berjalan akan dibatalkan.')">
                                        @csrf
                                        <button type="submit" class="btn-delete" style="background: #f59e0b;">
                                            <i class="fas fa-user-times"></i> Nonaktifkan
                                        </button>
                                    </form>
                                    @endif
                                    <button type="button" class="btn-delete" onclick="showDeleteModal('{{ $item->nip }}', '{{ $item->nama_lengkap }}', 'pegawai')">
                                        <i class="fas fa-trash"></i> Hapus
                                    </button>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="7" style="text-align: center; padding: 40px;">
                                    <i class="fas fa-users" style="font-size: 40px; color: #cbd5e1; display: block; margin-bottom: 10px;"></i>
                                    Belum ada data pegawai
                                </td>
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
                <p>Apakah Anda yakin akan menghapus data <strong id="deleteItemName"></strong>?</p>
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
            if (type === 'pegawai') {
                form.action = '/pegawai/' + id;
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