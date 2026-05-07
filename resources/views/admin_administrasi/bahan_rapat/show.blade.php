<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Bahan Rapat - Admin Administrasi</title>
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
        .card { background: white; border-radius: 20px; padding: 25px; box-shadow: 0 2px 8px rgba(0,0,0,0.04); max-width: 1000px; }
        .card-header { margin-bottom: 20px; border-bottom: 1px solid #e9ecef; padding-bottom: 15px; }
        .card-header h2 { font-size: 20px; font-weight: 600; color: #1e293b; }

        .section-title {
            font-size: 16px;
            font-weight: 700;
            color: #1e293b;
            margin: 20px 0 15px 0;
            padding-left: 10px;
            border-left: 4px solid #2a5298;
        }

        .detail-group { margin-bottom: 15px; }
        .detail-group label { font-weight: 600; color: #1e293b; font-size: 13px; display: block; margin-bottom: 5px; }
        .detail-group p { color: #334155; font-size: 14px; background: #f8fafc; padding: 8px 12px; border-radius: 8px; }

        .kajian-box {
            background: #f8fafc;
            padding: 15px;
            border-radius: 10px;
            border-left: 4px solid #2a5298;
            white-space: pre-line;
            font-size: 14px;
            line-height: 1.6;
        }

        .status-badge {
            display: inline-block;
            padding: 4px 10px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 500;
        }
        .status-menunggu { background: #fef9c3; color: #854d0e; }
        .status-disetujui { background: #dcfce7; color: #166534; }
        .status-ditolak { background: #fee2e2; color: #991b1b; }

        .form-group { margin-bottom: 20px; }
        label { display: block; font-weight: 600; margin-bottom: 6px; font-size: 13px; color: #1e293b; }
        textarea {
            width: 100%;
            padding: 10px 12px;
            border: 1px solid #e2e8f0;
            border-radius: 10px;
            font-family: 'Inter', sans-serif;
            font-size: 14px;
            resize: vertical;
            min-height: 100px;
        }
        textarea:focus { outline: none; border-color: #2a5298; box-shadow: 0 0 0 3px rgba(42,82,152,0.1); }

        .form-actions { margin-top: 25px; display: flex; gap: 12px; border-top: 1px solid #e9ecef; padding-top: 20px; flex-wrap: wrap; }
        .btn-approve {
            background: #22c55e;
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
        .btn-approve:hover { background: #16a34a; transform: translateY(-1px); }
        .btn-reject {
            background: #ef4444;
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
        .btn-reject:hover { background: #dc2626; transform: translateY(-1px); }
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
        .btn-draft {
            background: #f59e0b;
            color: white;
            padding: 10px 24px;
            border-radius: 8px;
            text-decoration: none;
            font-weight: 600;
            font-size: 14px;
            display: inline-flex;
            align-items: center;
            gap: 8px;
        }
        .btn-draft:hover { background: #d97706; transform: translateY(-1px); }
        .btn-final {
            background: #10b981;
            color: white;
            padding: 10px 24px;
            border-radius: 8px;
            text-decoration: none;
            font-weight: 600;
            font-size: 14px;
            display: inline-flex;
            align-items: center;
            gap: 8px;
        }
        .btn-final:hover { background: #059669; transform: translateY(-1px); }

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
        .modal.show { display: flex; }
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
        .modal-header h3 { font-size: 18px; font-weight: 600; color: #1e293b; margin: 0; }
        .modal-body { padding: 20px; }
        .modal-body p { font-size: 14px; color: #334155; margin-bottom: 8px; line-height: 1.5; }
        .modal-footer {
            padding: 16px 20px;
            background: #f8fafc;
            border-top: 1px solid #e2e8f0;
            text-align: right;
        }
        .modal-btn-confirm {
            background: #22c55e;
            color: white;
            border: none;
            padding: 8px 20px;
            border-radius: 6px;
            font-size: 14px;
            font-weight: 500;
            cursor: pointer;
            margin-left: 10px;
        }
        .modal-btn-confirm:hover { background: #16a34a; }
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
        .modal-btn-cancel:hover { background: #e2e8f0; }

        @media (max-width: 768px) { 
            .dashboard-wrapper { flex-direction: column; } 
            .sidebar { width: 100%; }
            .form-actions { flex-direction: column; }
            .form-actions a, .form-actions button { text-align: center; justify-content: center; }
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
                <li><a href="{{ url('/dashboard/admin_administrasi') }}"><i class="fas fa-chart-line"></i> Dashboard</a></li>
                <li class="active"><a href="{{ url('/bahan-rapat/admin') }}"><i class="fas fa-file-alt"></i> Bahan Rapat</a></li>
                <li><a href="{{ url('/admin_administrasi/sk') }}"><i class="fas fa-certificate"></i> Kelola SK</a></li>
                <li><a href="{{ url('/admin_administrasi/sk/arsip') }}"><i class="fas fa-archive"></i> Arsip SK</a></li>
                <li><a href="{{ url('/admin_administrasi/riwayat-usulan') }}"><i class="fas fa-history"></i> Riwayat Usulan</a></li>
                <li><a href="{{ url('/admin_administrasi/log-integrasi') }}"><i class="fas fa-exchange-alt"></i> Log Integrasi</a></li>
            </ul>
        </div>

        <div class="main-content">
            <div class="card">
                <div class="card-header">
                    <h2><i class="fas fa-file-alt"></i> Detail Bahan Rapat</h2>
                </div>

                <div class="detail-group">
                    <label>Nomor Bahan</label>
                    <p>{{ $bahanRapat->nomor_bahan }}</p>
                </div>

                <div class="detail-group">
                    <label>Tanggal Bahan</label>
                    <p>{{ \Carbon\Carbon::parse($bahanRapat->tanggal_bahan)->format('d-m-Y') }}</p>
                </div>

                <div class="detail-group">
                    <label>Status</label>
                    <p>
                        @if($bahanRapat->status_bahan == 'menunggu_persetujuan')
                            <span class="status-badge status-menunggu">Menunggu Persetujuan</span>
                        @elseif($bahanRapat->status_bahan == 'disetujui')
                            <span class="status-badge status-disetujui">Disetujui</span>
                        @else
                            <span class="status-badge status-ditolak">Ditolak</span>
                        @endif
                    </p>
                </div>

                <!-- DATA PEGAWAI & USULAN (LOOP UNTUK MULTIPLE USULAN) -->
                @foreach($bahanRapat->usulan as $index => $usul)
                <div class="section-title">Data Pegawai {{ $index + 1 }}</div>
                <div class="detail-group">
                    <label>Nama Pegawai</label>
                    <p>{{ $usul->pegawai->nama_lengkap ?? '-' }}</p>
                </div>
                <div class="detail-group">
                    <label>NIP</label>
                    <p>{{ $usul->pegawai->nip ?? '-' }}</p>
                </div>
                <div class="detail-group">
                    <label>Pangkat / Golongan</label>
                    <p>{{ $usul->pegawai->pangkat ?? '-' }} / {{ $usul->pegawai->golongan ?? '-' }}</p>
                </div>
                <div class="detail-group">
                    <label>Unit Kerja</label>
                    <p>{{ $usul->unit_kerja_lama }}</p>
                </div>

                <div class="section-title">Data Usulan {{ $index + 1 }}</div>
                <div class="detail-group">
                    <label>Jenis Usulan</label>
                    <p>
                        @if($usul->jenis_usulan == 'kenaikan')
                            Kenaikan Jabatan
                        @elseif($usul->jenis_usulan == 'perpindahan')
                            Perpindahan
                        @else
                            Pemberhentian
                        @endif
                    </p>
                </div>
                <div class="detail-group">
                    <label>Jabatan Lama</label>
                    <p>{{ $usul->jabatan_lama }} ({{ $usul->golongan_lama }})</p>
                </div>
                @if($usul->jenis_usulan == 'kenaikan')
                <div class="detail-group">
                    <label>Jabatan Baru</label>
                    <p>{{ $usul->jabatan_baru }} ({{ $usul->golongan_baru }})</p>
                </div>
                @endif
                
                @if(!$loop->last)
                <hr>
                @endif
                @endforeach

                <div class="section-title">Kajian</div>
                <div class="kajian-box">
                    {{ $bahanRapat->kajian_otomatis }}
                </div>

                <!-- DOWNLOAD BUTTONS (DRAFT + FINAL UNTUK ADMIN ADMINISTRASI) -->
                <div style="display: flex; gap: 12px; margin: 20px 0; flex-wrap: wrap;">
                    <a href="{{ url('/bahan-rapat/' . $bahanRapat->id . '/download-draft') }}" class="btn-draft">
                        <i class="fas fa-file-word"></i> Download Draft
                    </a>
                    <a href="{{ url('/bahan-rapat/' . $bahanRapat->id . '/download-final') }}" class="btn-final">
                        <i class="fas fa-check-circle"></i> Download Final
                    </a>
                </div>

                @if($bahanRapat->status_bahan == 'menunggu_persetujuan')
                <div class="section-title">Persetujuan</div>
                
                <form action="{{ url('/bahan-rapat/admin/' . $bahanRapat->id . '/approve') }}" method="POST" id="approveForm">
                    @csrf
                </form>
                <form action="{{ url('/bahan-rapat/admin/' . $bahanRapat->id . '/reject') }}" method="POST" id="rejectForm">
                    @csrf
                </form>

                <div class="form-group">
                    <label>Alasan / Catatan (wajib jika ditolak)</label>
                    <textarea name="alasan" form="rejectForm" placeholder="Isikan alasan jika bahan rapat ditolak..."></textarea>
                </div>

                <div class="form-actions">
                    <button type="button" class="btn-approve" onclick="showApproveModal()">
                        <i class="fas fa-check-circle"></i> Setujui
                    </button>
                    <button type="button" class="btn-reject" onclick="showRejectModal()">
                        <i class="fas fa-times-circle"></i> Tolak
                    </button>
                    <a href="{{ url('/bahan-rapat/admin') }}" class="btn-back">
                        <i class="fas fa-arrow-left"></i> Kembali
                    </a>
                </div>
                @else
                <div class="form-actions" style="margin-top: 25px;">
                    <a href="{{ url('/bahan-rapat/admin') }}" class="btn-back">
                        <i class="fas fa-arrow-left"></i> Kembali
                    </a>
                </div>
                @endif
            </div>
        </div>
    </div>

    <div id="approveModal" class="modal">
        <div class="modal-content">
            <div class="modal-header"><h3>Konfirmasi Persetujuan</h3></div>
            <div class="modal-body">
                <p>Apakah Anda yakin akan <strong>menyetujui</strong> bahan rapat ini?</p>
                <p>Setelah disetujui, SK dapat diterbitkan.</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="modal-btn-confirm" onclick="submitApprove()">Setujui</button>
                <button type="button" class="modal-btn-cancel" onclick="closeApproveModal()">Batal</button>
            </div>
        </div>
    </div>

    <div id="rejectModal" class="modal">
        <div class="modal-content">
            <div class="modal-header"><h3>Konfirmasi Penolakan</h3></div>
            <div class="modal-body">
                <p>Apakah Anda yakin akan <strong>menolak</strong> bahan rapat ini?</p>
                <p>Alasan penolakan akan dicatat dalam sistem.</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="modal-btn-confirm" onclick="submitReject()">Tolak</button>
                <button type="button" class="modal-btn-cancel" onclick="closeRejectModal()">Batal</button>
            </div>
        </div>
    </div>

    <script>
        function showApproveModal() { document.getElementById('approveModal').classList.add('show'); }
        function closeApproveModal() { document.getElementById('approveModal').classList.remove('show'); }
        function submitApprove() { document.getElementById('approveForm').submit(); }

        function showRejectModal() { document.getElementById('rejectModal').classList.add('show'); }
        function closeRejectModal() { document.getElementById('rejectModal').classList.remove('show'); }
        function submitReject() {
            var alasan = document.querySelector('textarea[name="alasan"]').value.trim();
            if (alasan === '') { alert('Alasan penolakan harus diisi!'); return; }
            document.getElementById('rejectForm').submit();
        }

        window.onclick = function(event) {
            var approveModal = document.getElementById('approveModal');
            var rejectModal = document.getElementById('rejectModal');
            if (event.target == approveModal) approveModal.classList.remove('show');
            if (event.target == rejectModal) rejectModal.classList.remove('show');
        }
    </script>
</body>
</html>