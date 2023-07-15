<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SettingTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('setting')->insert([
            'id_setting' => 1,
            'nama_perusahaan' => 'Arus Kas',
            'alamat' => 'Jl. CInere Raya No.07',
            'telepon' => '081316109035',
            'tipe_nota' => 1, //kecil
            'diskon' => 5,
            'path_logo' => '/img/cart-logo.png',
            'path_kartu_member' => '/img/member.png',
        ]);
    }
}
