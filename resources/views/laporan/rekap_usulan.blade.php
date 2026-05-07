<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rekapitulasi Usulan - Admin Administrasi</title>
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
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.04);
        }

        .card-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
            flex-wrap: wrap;
            gap: 15px;
            border-bottom: 1px solid #e9ecef;
            padding-bottom: 15px;
        }

        .card-header h2 {
            font-size: 20px;
            font-weight: 600;
            color: #1e293b;
        }

        .filter-section {
            display: flex;
            gap: 15px;
            margin-bottom: 20px;
            align-items: center;
            background: #f8fafc;
            padding: 15px;
            border-radius: 12px;
        }

        .filter-section select,
        .filter-section input {
            padding: 8px 12px;
            border: 1px solid #e2e8f0;
            border-radius: 8px;
            font-family: 'Inter', sans-serif;
            font-size: 14px;
        }

        .btn-filter {
            background: #3b82f6;
            color: white;
            padding: 8px 16px;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            font-weight: 500;
            font-size: 14px;
            display: inline-flex;
            align-items: center;
            gap: 6px;
        }

        .btn-filter:hover {
            background: #2563eb;
        }

        .btn-export {
            background: #10b981;
            color: white;
            padding: 8px 16px;
            border-radius: 8px;
            text-decoration: none;
            font-size: 14px;
            font-weight: 500;
            display: inline-flex;
            align-items: center;
            gap: 6px;
        }

        .btn-export:hover {
            background: #059669;
        }

        .table-responsive {
            overflow-x: auto;
            -webkit-overflow-scrolling: touch;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            min-width: 1000px;
        }

        th,
        td {
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

        td:first-child,
        th:first-child {
            padding-left: 20px;
        }

        td:last-child,
        th:last-child {
            padding-right: 20px;
        }

        .status-badge {
            padding: 4px 10px;
            border-radius: 6px;
            font-size: 12px;
            font-weight: 600;
            display: inline-block;
            white-space: nowrap;
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
        }
    </style>
</head>

<body>
    @php
        /** 
         * @var string $bulan 
         * @var string $tahun 
         * @var \Illuminate\Database\Eloquent\Collection $usulan 
         */
    @endphp
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
                <li><a href="{{ url('/dashboard/admin_administrasi') }}"><i class="fas fa-chart-line"></i> Dashboard</a>
                </li>
                <li><a href="{{ url('/admin_administrasi/sk') }}"><i class="fas fa-file-signature"></i> Kelola SK</a>
                </li>
                <li><a href="{{ url('/bahan-rapat/admin') }}"><i class="fas fa-file-alt"></i> Persetujuan Bahan
                        Rapat</a></li>
                <li><a href="{{ url('/admin_administrasi/sk/arsip') }}"><i class="fas fa-archive"></i> Arsip SK</a></li>
                <li><a href="{{ url('/admin_administrasi/riwayat-usulan') }}"><i class="fas fa-history"></i> Riwayat
                        Usulan</a></li>
                <li class="active"><a href="{{ url('/admin_administrasi/laporan/rekap-usulan') }}"><i class="fas fa-chart-bar"></i> Laporan
                        Rekap Usulan</a></li>
                <li><a href="{{ url('/admin_administrasi/log-integrasi') }}"><i class="fas fa-exchange-alt"></i> Log
                        Integrasi SIASN</a></li>
            </ul>
        </div>

        <div class="main-content">
            <div class="card">
                <div class="card-header">
                    <h2><i class="fas fa-chart-bar"></i> Rekapitulasi Usulan</h2>
                    <a href="{{ route('laporan.export_csv', ['bulan' => $bulan, 'tahun' => $tahun]) }}"
                        class="btn-export">
                        <i class="fas fa-file-csv"></i> Export CSV
                    </a>
                </div>

                <form method="GET" action="{{ route('laporan.rekap_usulan') }}" class="filter-section">
                    <div>
                        <select name="bulan">
                            <option value="">Semua Bulan</option>
                            @for($i = 1; $i <= 12; $i++)
                                <option value="{{ str_pad($i, 2, '0', STR_PAD_LEFT) }}" {{ $bulan == str_pad($i, 2, '0', STR_PAD_LEFT) ? 'selected' : '' }}>
                                    {{ date('F', mktime(0, 0, 0, $i, 1)) }}
                                </option>
                            @endfor
                        </select>
                    </div>
                    <div>
                        <select name="tahun">
                            <option value="">Semua Tahun</option>
                            @for($i = date('Y'); $i >= 2020; $i--)
                                <option value="{{ $i }}" {{ $tahun == $i ? 'selected' : '' }}>{{ $i }}</option>
                            @endfor
                        </select>
                    </div>
                    <button type="submit" class="btn-filter"><i class="fas fa-filter"></i> Tampilkan</button>
                </form>

                <div class="table-responsive">
                    <table>
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>NIP</th>
                                <th>Nama Pegawai</th>
                                <th>OPD Pengusul</th>
                                <th>Jenis Usulan</th>
                                <th>Jabatan Lama</th>
                                <th>Jabatan Baru</th>
                                <th>Status</th>
                                <th>Tanggal Usulan</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($usulan as $key => $item)
                                <tr>
                                    <td>{{ $key + 1 }}</td>
                                    <td>{{ $item->nip }}</td>
                                    <td>{{ $item->pegawai->nama_lengkap ?? '-' }}</td>
                                    <td>{{ $item->opd->nama_opd ?? '-' }}</td>
                                    <td>
                                        @if($item->jenis_usulan == 'promosi') Promosi
                                        @elseif($item->jenis_usulan == 'mutasi') Mutasi
                                        @elseif($item->jenis_usulan == 'demosi') Demosi
                                        @elseif($item->jenis_usulan == 'pemberhentian') Pemberhentian
                                        @else {{ ucfirst($item->jenis_usulan) }} @endif
                                    </td>
                                    <td>{{ $item->jabatan_lama }}</td>
                                    <td>{{ $item->jabatan_baru ?? '-' }}</td>
                                    <td>
                                        <span class="status-badge" style="background: #f1f5f9; color: #475569;">
                                            {{ str_replace('_', ' ', ucfirst($item->status)) }}
                                        </span>
                                    </td>
                                    <td>{{ $item->created_at->format('d/m/Y') }}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="9" style="text-align: center; padding: 40px;">
                                        <i class="fas fa-folder-open"
                                            style="font-size: 40px; color: #cbd5e1; display: block; margin-bottom: 10px;"></i>
                                        Tidak ada data usulan untuk periode ini
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