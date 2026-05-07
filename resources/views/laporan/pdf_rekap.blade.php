<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Rekapitulasi Usulan Jabatan Fungsional</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 12px;
            color: #333;
        }
        .header {
            text-align: center;
            margin-bottom: 20px;
            border-bottom: 2px solid #333;
            padding-bottom: 10px;
        }
        .header h2 {
            margin: 0 0 5px 0;
            font-size: 18px;
            text-transform: uppercase;
        }
        .header p {
            margin: 0;
            font-size: 14px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 15px;
        }
        table, th, td {
            border: 1px solid #555;
        }
        th, td {
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
            font-weight: bold;
            text-align: center;
        }
        .text-center {
            text-align: center;
        }
        .status-badge {
            padding: 4px 8px;
            border-radius: 4px;
            font-size: 11px;
            font-weight: bold;
            color: white;
            display: inline-block;
        }
        .badge-success { background-color: #10b981; }
        .badge-danger { background-color: #ef4444; }
        .badge-warning { background-color: #f59e0b; }
        .badge-secondary { background-color: #6b7280; }
    </style>
</head>
<body>
    <div class="header">
        <h2>Rekapitulasi Usulan Jabatan Fungsional</h2>
        <p>BKPSDM Kabupaten Kudus</p>
        <p>Bulan: {{ str_pad($bulan, 2, '0', STR_PAD_LEFT) }} / Tahun: {{ $tahun }}</p>
    </div>

    <table>
        <thead>
            <tr>
                <th width="5%">No</th>
                <th width="15%">NIP</th>
                <th width="20%">Nama Pegawai</th>
                <th width="15%">OPD Pengusul</th>
                <th width="10%">Jenis Usulan</th>
                <th width="15%">Jabatan Lama</th>
                <th width="15%">Jabatan Baru</th>
                <th width="10%">Status</th>
            </tr>
        </thead>
        <tbody>
            @forelse($usulan as $index => $item)
            <tr>
                <td class="text-center">{{ $index + 1 }}</td>
                <td>{{ $item->nip }}</td>
                <td>{{ $item->pegawai->nama_lengkap ?? '-' }}</td>
                <td>{{ $item->opd->nama_opd ?? '-' }}</td>
                <td class="text-center">{{ ucfirst($item->jenis_usulan) }}</td>
                <td>
                    {{ $item->jabatan_lama }}<br>
                    <small>Gol: {{ $item->golongan_lama }}</small>
                </td>
                <td>
                    @if($item->jenis_usulan == 'pemberhentian')
                        <i style="color:#777;">(Pemberhentian)</i>
                    @else
                        {{ $item->jabatan_baru ?? '-' }}<br>
                        @if($item->golongan_baru)
                            <small>Gol: {{ $item->golongan_baru }}</small>
                        @endif
                    @endif
                </td>
                <td class="text-center">
                    @php
                        $statusText = str_replace('_', ' ', ucfirst($item->status));
                        $badgeClass = 'badge-secondary';
                        if($item->status == 'disetujui') $badgeClass = 'badge-success';
                        elseif($item->status == 'ditolak') $badgeClass = 'badge-danger';
                        elseif($item->status == 'dibatalkan') $badgeClass = 'badge-warning';
                    @endphp
                    <span class="status-badge {{ $badgeClass }}">{{ $statusText }}</span>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="8" class="text-center">Tidak ada data usulan pada periode ini.</td>
            </tr>
            @endforelse
        </tbody>
    </table>

    <div style="margin-top: 30px; text-align: right;">
        <p>Kudus, {{ date('d M Y') }}</p>
        <br><br><br>
        <p><strong>Admin BKPSDM</strong></p>
    </div>
</body>
</html>
