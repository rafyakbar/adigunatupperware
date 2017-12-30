<?php

use Illuminate\Database\Seeder;
use App\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => 'Rafy Aulia Akbar',
            'email' => 'rafyakbar@mhs.unesa.ac.id',
            'nohp' => '087789891729',
            'password' => bcrypt('secret'),
            'hak_akses' => 'pemilik'
        ]);

        User::create([
            'name' => 'Ulin Nuha',
            'email' => 'ulinnuha@mhs.unesa.ac.id',
            'nohp' => '085812051570',
            'password' => bcrypt('secret'),
            'hak_akses' => 'pemilik'
        ]);

        User::create([
            'name' => 'Iin Adiguna',
            'email' => 'iin.adiguna@yahoo.com',
            'nohp' => '081234568900',
            'password' => bcrypt('secret'),
            'hak_akses' => 'pemilik'
        ]);

        User::create([
            'name' => 'Pegawai Pertama',
            'email' => 'pegawai1@email.com',
            'nohp' => '081234568901',
            'password' => bcrypt('secret'),
            'hak_akses' => 'pegawai'
        ]);

        User::create([
            'name' => 'Pegawai Kedua',
            'email' => 'pegawai2@email.com',
            'nohp' => '081234568902',
            'password' => bcrypt('secret'),
            'hak_akses' => 'pegawai'
        ]);
    }
}
