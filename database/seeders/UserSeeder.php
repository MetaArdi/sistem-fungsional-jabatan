<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Masukkan data OPD dummy terlebih dahulu agar id_opd bisa direlasikan (opsional, tergantung skema)
        // Kita asumsikan opd sudah ada, atau kita tidak set id_opd secara strict FK jika belum ada.
        // Jika ada tabel opd, kita bisa seed juga.

        DB::table('opd')->insertOrIgnore([
            ['id_opd' => 1, 'nama_opd' => 'Badan Kepegawaian dan Pengembangan Sumber Daya Manusia (BKPSDM)'],
            ['id_opd' => 2, 'nama_opd' => 'Dinas Kesehatan'],
            ['id_opd' => 3, 'nama_opd' => 'Dinas Pendidikan'],
        ]);

        $users = [
            [
                'username' => 'admin_sistem',
                'password' => Hash::make('password'),
                'role' => 'admin_sistem',
            ],
            [
                'username' => 'admin_opd',
                'password' => Hash::make('password'),
                'role' => 'admin_opd',
            ],
            [
                'username' => 'admin_opd2',
                'password' => Hash::make('password'),
                'role' => 'admin_opd',
            ],
            [
                'username' => 'verifikator',
                'password' => Hash::make('password'),
                'role' => 'verifikator',
            ],
            [
                'username' => 'admin_administrasi',
                'password' => Hash::make('password'),
                'role' => 'admin_administrasi',
            ],
        ];

        foreach ($users as $user) {
            DB::table('users')->updateOrInsert(
                ['username' => $user['username']],
                $user
            );
        }
    }
}
