<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Verifikasi - Verifikator</title>
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

        .file-link { color: #2a5298; text-decoration: none; }
        .file-link:hover { text-decoration: underline; }

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

        .form-actions { margin-top: 25px; display: flex; gap: 12px; border-top: 1px solid #e9ecef; padding-top: 20px; }
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

        .alert-success {
            background: #dcfce7;
            color: #166534;
            padding: 12px 16px;
            border-radius: 12px;
            margin-bottom: 20px;
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
        .modal-btn-confirm:hover {
            background: #16a34a;
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

        @media (max-width: 768px) { .dashboard-wrapper { flex-direction: column; } .sidebar { width: 100%; } }
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
                <li><a href="{{ url('/dashboard/verifikator') }}"><i class="fas fa-chart-line"></i> Dashboard</a></li>
                <li class="active"><a href="{{ url('/verifikasi') }}"><i class="fas fa-check-circle"></i> Verifikasi Usulan</a></li>
                <li><a href="#"><i class="fas fa-file-alt"></i> Bahan Rapat</a></li>
            </ul>
        </div>

        <div class="main-content">
            <div class="card">
                <div class="card-header">
                    <h2><i class="fas fa-check-circle"></i> Detail Verifikasi</h2>
                </div>

                @if(session('success'))
                    <div class="alert-success">
                        {{ session('success') }}
                    </div>
                @endif

                <!-- Data Pegawai -->
                <div class="section-title">A. Data Pegawai</div>
                <div class="detail-group">
                    <label>NIP</label>
                    <p>{{ $usulan->pegawai->nip ?? $usulan->nip }}</p>
                </div>
                <div class="detail-group">
                    <label>Nama Lengkap</label>
                    <p>{{ $usulan->pegawai->nama_lengkap ?? '-' }}</p>
                </div>
                <div class="detail-group">
                    <label>Tempat, Tanggal Lahir</label>
                    <p>{{ $usulan->pegawai->tempat_lahir ?? '-' }}, {{ isset($usulan->pegawai->tanggal_lahir) ? \Carbon\Carbon::parse($usulan->pegawai->tanggal_lahir)->format('d-m-Y') : '-' }}</p>
                </div>
                <div class="detail-group">
                    <label>Pangkat / Golongan</label>
                    <p>{{ $usulan->pegawai->pangkat ?? '-' }} / {{ $usulan->pegawai->golongan ?? '-' }}</p>
                </div>

                <!-- Data Usulan -->
                <div class="section-title">B. Data Usulan</div>
                <div class="detail-group">
                    <label>Jenis Usulan</label>
                    <p>
                        @if($usulan->jenis_usulan == 'promosi')
                            Promosi (Kenaikan Jabatan)
                        @elseif($usulan->jenis_usulan == 'mutasi')
                            Mutasi (Perpindahan)
                        @elseif($usulan->jenis_usulan == 'demosi')
                            Demosi (Penurunan Jabatan)
                        @else
                            Pemberhentian
                        @endif
                    </p>
                </div>
                <div class="detail-group">
                    <label>Jabatan Lama</label>
                    <p>{{ $usulan->jabatan_lama }} ({{ $usulan->golongan_lama }})</p>
                </div>
                <div class="detail-group">
                    <label>Unit Kerja Lama</label>
                    <p>{{ $usulan->unit_kerja_lama }}</p>
                </div>

                @if($usulan->jenis_usulan == 'promosi')
                <div class="detail-group">
                    <label>Jabatan Baru</label>
                    <p>{{ $usulan->jabatan_baru }} ({{ $usulan->golongan_baru }})</p>
                </div>
                <div class="detail-group">
                    <label>Angka Kredit Usulan</label>
                    <p>{{ number_format($usulan->angka_kredit_usulan, 3, ',', '.') }}</p>
                </div>
                @endif

                @if(in_array($usulan->jenis_usulan, ['mutasi', 'demosi']))
                <div class="detail-group">
                    <label>Unit Kerja Tujuan</label>
                    <p>{{ $usulan->unit_kerja_tujuan }}</p>
                </div>
                <div class="detail-group">
                    <label>Alasan {{ ucfirst($usulan->jenis_usulan) }}</label>
                    <p>{{ $usulan->alasan_perpindahan }}</p>
                </div>
                @endif

                @if($usulan->jenis_usulan == 'pemberhentian')
                <div class="detail-group">
                    <label>Alasan Pemberhentian</label>
                    <p>{{ $usulan->alasan_pemberhentian }}</p>
                </div>
                <div class="detail-group">
                    <label>Tanggal Efektif</label>
                    <p>{{ \Carbon\Carbon::parse($usulan->tanggal_efektif)->format('d-m-Y') }}</p>
                </div>
                @endif

                <!-- Surat Pengantar -->
                <div class="section-title">C. Surat Pengantar</div>
                <div class="detail-group">
                    <label>Nomor Surat</label>
                    <p>{{ $usulan->nomor_surat }}</p>
                </div>
                <div class="detail-group">
                    <label>Jenis Surat</label>
                    <p>{{ $usulan->jenis_surat }}</p>
                </div>
                <div class="detail-group">
                    <label>Banyaknya</label>
                    <p>{{ $usulan->jumlah_bandel }} bandel</p>
                </div>
                <div class="detail-group">
                    <label>Keterangan</label>
                    <p>{{ $usulan->keterangan_surat }}</p>
                </div>
                <div class="detail-group">
                    <label>File Surat Pengantar</label>
                    <p><a href="{{ asset('storage/' . $usulan->file_surat_pengantar) }}" target="_blank" class="file-link"><i class="fas fa-file-pdf"></i> Lihat Surat Pengantar</a></p>
                </div>

                <!-- Berkas Persyaratan -->
                <div class="section-title">D. Berkas Persyaratan</div>
                <div class="detail-group">
                    <label>SK CPNS</label>
                    <p>
                        @php $sk_cpns = $usulan->berkas->where('jenis_berkas', 'sk_cpns')->first(); @endphp
                        @if($sk_cpns)
                            <a href="{{ asset('storage/' . $sk_cpns->path_file) }}" target="_blank" class="file-link"><i class="fas fa-file-pdf"></i> Lihat SK CPNS</a>
                        @else
                            <span style="color: #999;">Tidak diupload</span>
                        @endif
                    </p>
                </div>
                <div class="detail-group">
                    <label>SK PNS</label>
                    <p>
                        @php $sk_pns = $usulan->berkas->where('jenis_berkas', 'sk_pns')->first(); @endphp
                        @if($sk_pns)
                            <a href="{{ asset('storage/' . $sk_pns->path_file) }}" target="_blank" class="file-link"><i class="fas fa-file-pdf"></i> Lihat SK PNS</a>
                        @else
                            <span style="color: #999;">Tidak diupload</span>
                        @endif
                    </p>
                </div>
                <div class="detail-group">
                    <label>SK Jabatan Terakhir</label>
                    <p>
                        @php $sk_jabatan = $usulan->berkas->where('jenis_berkas', 'sk_jabatan')->first(); @endphp
                        @if($sk_jabatan)
                            <a href="{{ asset('storage/' . $sk_jabatan->path_file) }}" target="_blank" class="file-link"><i class="fas fa-file-pdf"></i> Lihat SK Jabatan</a>
                        @else
                            <span style="color: #999;">Tidak diupload</span>
                        @endif
                    </p>
                </div>
                <div class="detail-group">
                    <label>Sertifikat Uji Kompetensi</label>
                    <p>
                        @php $sertifikat = $usulan->berkas->where('jenis_berkas', 'sertifikat_uk')->first(); @endphp
                        @if($sertifikat)
                            <a href="{{ asset('storage/' . $sertifikat->path_file) }}" target="_blank" class="file-link"><i class="fas fa-file-pdf"></i> Lihat Sertifikat UK</a>
                        @else
                            <span style="color: #999;">Tidak diupload</span>
                        @endif
                    </p>
                </div>
                <div class="detail-group">
                    <label>Angka Kredit (PAK)</label>
                    <p>
                        @php $pak = $usulan->berkas->where('jenis_berkas', 'angka_kredit')->first(); @endphp
                        @if($pak)
                            <a href="{{ asset('storage/' . $pak->path_file) }}" target="_blank" class="file-link"><i class="fas fa-file-pdf"></i> Lihat Angka Kredit</a>
                        @else
                            <span style="color: #999;">Tidak diupload</span>
                        @endif
                    </p>
                </div>

                <!-- Form Verifikasi -->
                <div class="section-title">E. Verifikasi</div>
                
                @if(in_array($usulan->status, ['menunggu_verifikasi_berkas', 'revisi_berkas']))
                    <!-- Verifikasi Berkas -->
                    <form action="{{ route('verifikasi.berkas', $usulan->id) }}" method="POST" id="berkasForm">
                        @csrf
                        <div class="form-group">
                            <label>Status Berkas <span style="color:red;">*</span></label>
                            <select name="status_berkas" id="status_berkas" class="form-control" required style="width:100%; padding:10px; border-radius:8px; border:1px solid #e2e8f0; margin-bottom:15px;">
                                <option value="">Pilih Keputusan Berkas</option>
                                <option value="valid">Valid (Lanjut ke Verifikasi Substansi)</option>
                                <option value="perlu_revisi">Perlu Revisi (Kembalikan ke OPD)</option>
                            </select>
                        </div>
                        <div class="form-group" id="catatanBerkasGroup" style="display:none;">
                            <label>Catatan / Alasan Revisi <span style="color:red;">*</span></label>
                            <textarea name="catatan" placeholder="Jelaskan bagian mana yang perlu direvisi..."></textarea>
                        </div>
                        <div class="form-actions">
                            <button type="submit" class="btn-approve" onclick="return confirm('Simpan hasil verifikasi berkas?')">
                                <i class="fas fa-save"></i> Simpan Verifikasi Berkas
                            </button>
                            <a href="{{ url('/verifikasi') }}" class="btn-back">
                                <i class="fas fa-arrow-left"></i> Kembali
                            </a>
                        </div>
                    </form>
                    
                    <script>
                        document.getElementById('status_berkas').addEventListener('change', function() {
                            if (this.value === 'perlu_revisi') {
                                document.getElementById('catatanBerkasGroup').style.display = 'block';
                            } else {
                                document.getElementById('catatanBerkasGroup').style.display = 'none';
                            }
                        });
                    </script>

                @elseif($usulan->status == 'menunggu_verifikasi_substansi')
                    <!-- Verifikasi Substansi -->
                    <form action="{{ route('verifikasi.substansi', $usulan->id) }}" method="POST" id="substansiForm">
                        @csrf
                        <div class="form-group">
                            <label>Keputusan Substansi <span style="color:red;">*</span></label>
                            <select name="keputusan" id="keputusan_substansi" class="form-control" required style="width:100%; padding:10px; border-radius:8px; border:1px solid #e2e8f0; margin-bottom:15px;">
                                <option value="">Pilih Keputusan</option>
                                <option value="disetujui">Disetujui</option>
                                <option value="ditolak">Ditolak</option>
                                <option value="dibatalkan">Dibatalkan (Kondisi Khusus)</option>
                            </select>
                        </div>
                        <div class="form-group" id="alasanSubstansiGroup" style="display:none;">
                            <label>Alasan Penolakan / Pembatalan <span style="color:red;">*</span></label>
                            <textarea name="alasan" placeholder="Isikan alasan..."></textarea>
                        </div>
                        <div class="form-actions">
                            <button type="submit" class="btn-approve" onclick="return confirm('Simpan hasil verifikasi substansi?')">
                                <i class="fas fa-save"></i> Simpan Keputusan Substansi
                            </button>
                            <a href="{{ url('/verifikasi') }}" class="btn-back">
                                <i class="fas fa-arrow-left"></i> Kembali
                            </a>
                        </div>
                    </form>

                    <script>
                        document.getElementById('keputusan_substansi').addEventListener('change', function() {
                            if (this.value === 'ditolak' || this.value === 'dibatalkan') {
                                document.getElementById('alasanSubstansiGroup').style.display = 'block';
                            } else {
                                document.getElementById('alasanSubstansiGroup').style.display = 'none';
                            }
                        });
                    </script>
                @endif
            </div>
        </div>
    </div>

    <script>
        // JS already inside specific forms
    </script>
</body>
</html>