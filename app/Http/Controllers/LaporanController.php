<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Usulan;
use Illuminate\Support\Facades\Response;

class LaporanController extends Controller
{
    public function rekapUsulan(Request $request)
    {
        $bulan = $request->input('bulan', date('m'));
        $tahun = $request->input('tahun', date('Y'));

        $query = Usulan::with(['pegawai', 'opd']);

        if ($bulan) {
            $query->whereMonth('created_at', $bulan);
        }
        if ($tahun) {
            $query->whereYear('created_at', $tahun);
        }

        $usulan = $query->orderBy('created_at', 'desc')->get();

        return view('laporan.rekap_usulan', compact('usulan', 'bulan', 'tahun'));
    }

    public function exportCsv(Request $request)
    {
        $bulan = $request->input('bulan', date('m'));
        $tahun = $request->input('tahun', date('Y'));

        $query = Usulan::with(['pegawai', 'opd']);

        if ($bulan) {
            $query->whereMonth('created_at', $bulan);
        }
        if ($tahun) {
            $query->whereYear('created_at', $tahun);
        }

        $usulan = $query->orderBy('created_at', 'desc')->get();

        $filename = "rekap_usulan_{$tahun}_{$bulan}.csv";
        
        $callback = function() use ($usulan) {
            $handle = fopen('php://output', 'w');
            fputs($handle, chr(0xEF) . chr(0xBB) . chr(0xBF)); // UTF-8 BOM

            fputcsv($handle, [
                'No', 'NIP', 'Nama Pegawai', 'OPD Pengusul', 
                'Jenis Usulan', 'Jabatan Lama', 'Jabatan Baru', 
                'Status', 'Tanggal Usulan'
            ], ';');

            $no = 1;
            foreach ($usulan as $item) {
                fputcsv($handle, [
                    $no++,
                    $item->nip,
                    $item->pegawai->nama_lengkap ?? '-',
                    $item->opd->nama_opd ?? '-',
                    ucfirst($item->jenis_usulan),
                    $item->jabatan_lama,
                    $item->jabatan_baru ?? '-',
                    str_replace('_', ' ', ucfirst($item->status)),
                    $item->created_at->format('Y-m-d')
                ], ';');
            }
            fclose($handle);
        };

        $headers = [
            'Content-Type' => 'text/csv; charset=UTF-8',
        ];

        return Response::streamDownload($callback, $filename, $headers);
    }
}
