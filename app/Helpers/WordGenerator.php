<?php

namespace App\Helpers;

use PhpOffice\PhpWord\PhpWord;
use PhpOffice\PhpWord\IOFactory;
use PhpOffice\PhpWord\SimpleType\Jc;

class WordGenerator
{
    public static function generateMultiple($usulanList, $besettingJf, $bahanRapat, $jenis = 'draft')
    {
        $phpWord = new PhpWord();

        $phpWord->setDefaultFontName('Times New Roman');
        $phpWord->setDefaultFontSize(11);

        $phpWord->setDefaultParagraphStyle([
            'alignment' => Jc::BOTH,
            'spaceAfter' => 0,
            'spaceBefore' => 0,
            'spacing' => 100
        ]);

        // ================= SECTION =================
        $section = $phpWord->addSection([
            'orientation' => 'landscape',
            'marginTop' => 1440,
            'marginBottom' => 1440,
            'marginLeft' => 1440,
            'marginRight' => 1440,
        ]);

        // ================= DRAFT =================
        if ($jenis == 'draft') {
            $section->addText(
                'DRAFT - BELUM FINAL',
                ['size' => 11, 'bold' => true],
                ['alignment' => Jc::CENTER]
            );
            $section->addTextBreak(1);
        }

        // ================= JUDUL =================
        $section->addText(
            'BAHAN RAPAT PERTIMBANGAN TIM PENILAI KINERJA PEGAWAI NEGERI SIPIL KABUPATEN KUDUS',
            ['bold' => true, 'size' => 11],
            ['alignment' => Jc::CENTER]
        );

        $section->addTextBreak(1);

        // ================= TABEL =================
        $phpWord->addTableStyle('mainTable', [
            'borderSize' => 6,
            'borderColor' => '000000',
            'cellMargin' => 80
        ]);

        $table = $section->addTable('mainTable');

        $headers = ['NO.', 'USULAN', 'FOTO', 'PNS YANG DIUSULKAN', 'JABATAN SAAT INI', 'USULAN JABATAN', 'KAJIAN'];
        $widths = [400, 2000, 800, 2800, 2000, 2000, 5800];

        $row = $table->addRow();
        foreach ($headers as $i => $h) {
            $row->addCell($widths[$i])->addText($h, ['bold' => true, 'size' => 10], ['alignment' => Jc::CENTER]);
        }

        foreach ($usulanList as $index => $usulan) {

            $pegawai = $usulan->pegawai;
            $row = $table->addRow();

            // NO
            $row->addCell($widths[0])->addText($index + 1, [], ['alignment' => Jc::CENTER]);

            // USULAN
            $row->addCell($widths[1])->addText(
                "Kenaikan Jabatan Fungsional\n" . ($usulan->jabatan_baru ?? '-')
            );

            // FOTO
            $row->addCell($widths[2])->addText('-', [], ['alignment' => Jc::CENTER]);

            // PNS
            $tmt = $pegawai->tmt_pangkat ? date('d-m-Y', strtotime($pegawai->tmt_pangkat)) : '-';

            $pns = ($pegawai->nama_lengkap ?? '-') . "\n" .
                   "NIP. " . ($pegawai->nip ?? '-') . "\n" .
                   "Pangkat " . ($pegawai->pangkat ?? '-') . " (" . ($pegawai->golongan ?? '-') . ")\n" .
                   "TMT " . $tmt . "\n" .
                   "Pendidikan " . ($pegawai->pendidikan_terakhir ?? '-') . " " . ($pegawai->jurusan ?? '-');

            $row->addCell($widths[3])->addText($pns);

            // JABATAN
            $row->addCell($widths[4])->addText($usulan->jabatan_lama ?? '-');
            $row->addCell($widths[5])->addText($usulan->jabatan_baru ?? '-');

            // ================= KAJIAN =================
            $cell = $row->addCell($widths[6]);

            $rapat = [
                'alignment' => Jc::BOTH,
                'spaceAfter' => 0,
                'spaceBefore' => 0,
                'lineHeight' => 1.0
            ];

            $bullet = [
                'alignment' => Jc::BOTH,
                'spaceAfter' => 0,
                'lineHeight' => 1.0,
                'indentation' => ['left' => 200]
            ];

            // DATA
            $noSertifikat = $pegawai->no_sertifikat ?? 'REG-XXXX';
            $masaBerlaku = $pegawai->masa_berlaku_sertifikat
                ? date('d F Y', strtotime($pegawai->masa_berlaku_sertifikat))
                : '08 Oktober 2027';

            $tahunPredikat = $pegawai->tahun_predikat_kinerja ?? date('Y') - 1;
            $angkaKredit = number_format((float)($usulan->angka_kredit_usulan ?? 0), 3, ',', '.');
            $usia = ($pegawai->usia_tahun ?? 0) . " tahun " . ($pegawai->usia_bulan ?? 0) . " bulan";
            $noSurat = $usulan->no_surat_panrb ?? 'B/4748/M.SM.01.00/2026';
            $tahunSurat = date('Y');

            // KALIMAT DINAS (DB / fallback)
            $kalimatDinas = $usulan->kalimat_dinas ?? null;

            if ($kalimatDinas) {
                $cell->addText($kalimatDinas, [], $rapat);
            } else {
                $run = $cell->addTextRun($rapat);
                $run->addText("Berdasarkan Sertifikat Uji Kompetensi Kementerian Kesehatan Republik Indonesia, ");
                $run->addText("No. $noSertifikat ", ['bold' => true]);
                $run->addText(
                    "Saudara/i {$pegawai->nama_lengkap} NIP. {$pegawai->nip} telah mengikuti Uji Kompetensi Kenaikan Jabatan Fungsional sebagai {$usulan->jabatan_baru} dan dinyatakan lulus serta memenuhi syarat dengan masa berlaku sampai $masaBerlaku;"
                );
            }

            // BULLET
            $cell->addText("➢ Predikat Kinerja tahun $tahunPredikat bernilai \"BAIK\";", [], $bullet);
            $cell->addText("➢ Penetapan Angka Kredit $angkaKredit;", [], $bullet);
            $cell->addText("➢ Pada saat mengajukan Kenaikan Jabatan berusia $usia;", [], $bullet);
            $cell->addText(
                "➢ Memperhatikan Surat Menteri PANRB tanggal 10 Oktober $tahunSurat Nomor $noSurat serta besetting JF:",
                [],
                $bullet
            );

            // TABEL BESETTING
            if ($besettingJf && count($besettingJf) > 0) {

                $phpWord->addTableStyle('jfTable', [
                    'borderSize' => 6,
                    'borderColor' => '000000',
                    'cellMargin' => 50
                ]);

                $t = $cell->addTable('jfTable');

                $t->addRow();
                $t->addCell(500)->addText("No", ['bold' => true], ['alignment' => Jc::CENTER]);
                $t->addCell(3000)->addText("Perangkat Daerah", ['bold' => true], ['alignment' => Jc::CENTER]);
                $t->addCell(800)->addText("B", ['bold' => true], ['alignment' => Jc::CENTER]);
                $t->addCell(800)->addText("K", ['bold' => true], ['alignment' => Jc::CENTER]);
                $t->addCell(800)->addText("+/-", ['bold' => true], ['alignment' => Jc::CENTER]);

                $no = 1;
                foreach ($besettingJf as $jf) {
                    $selisih = ($jf->kebutuhan ?? 0) - ($jf->ketersediaan ?? 0);

                    $t->addRow();
                    $t->addCell(500)->addText($no++, [], ['alignment' => Jc::CENTER]);
                    $t->addCell(3000)->addText($jf->jabatan_fungsional ?? '-');
                    $t->addCell(800)->addText($jf->kebutuhan ?? 0, [], ['alignment' => Jc::CENTER]);
                    $t->addCell(800)->addText($jf->ketersediaan ?? 0, [], ['alignment' => Jc::CENTER]);
                    $t->addCell(800)->addText($selisih, [], ['alignment' => Jc::CENTER]);
                }
            } else {
                $cell->addText("Data besetting JF tidak tersedia.", [], $rapat);
            }
        }

        // ================= TTD =================
        $section->addTextBreak(2);

        $section->addText(
            "Kudus, " . date('d') . " " . self::getBulanIndonesia(date('n')) . " " . date('Y'),
            [],
            ['alignment' => Jc::RIGHT]
        );

        $section->addTextBreak(1);

        $section->addText(
            "KEPALA BKPSDM KABUPATEN KUDUS",
            ['bold' => true],
            ['alignment' => Jc::RIGHT]
        );

        $section->addTextBreak(4);

        $section->addText(
            "(BUDI SANTOSO)",
            ['bold' => true, 'underline' => 'single'],
            ['alignment' => Jc::RIGHT]
        );

        $section->addText(
            "Pembina Utama Muda / IV.c",
            [],
            ['alignment' => Jc::RIGHT]
        );

        $section->addText(
            "NIP. 123456789012345678",
            [],
            ['alignment' => Jc::RIGHT]
        );

        // ================= SAVE =================
        if (!file_exists(storage_path('app/temp'))) {
            mkdir(storage_path('app/temp'), 0777, true);
        }

        $fileName = "BAHAN_RAPAT_" . date('Ymd_His') . ".docx";
        $path = storage_path("app/temp/" . $fileName);

        IOFactory::createWriter($phpWord, 'Word2007')->save($path);

        return [
            'path' => $path,
            'name' => $fileName
        ];
    }

    public static function generate($usulan, $pegawai, $besettingJf, $bahanRapat, $jenis = 'draft')
    {
        return self::generateMultiple(collect([$usulan]), $besettingJf, $bahanRapat, $jenis);
    }

    private static function getBulanIndonesia($bulan)
    {
        return [
            1 => 'Januari', 2 => 'Februari', 3 => 'Maret',
            4 => 'April', 5 => 'Mei', 6 => 'Juni',
            7 => 'Juli', 8 => 'Agustus', 9 => 'September',
            10 => 'Oktober', 11 => 'November', 12 => 'Desember'
        ][$bulan] ?? '';
    }
}