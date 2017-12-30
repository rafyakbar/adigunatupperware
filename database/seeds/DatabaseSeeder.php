<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \Illuminate\Database\Eloquent\Model::unguard();
        $this->call('UserSeeder');
        $this->call('KategoriSeeder');
        $this->call('BarangSeeder');
        $this->call('PesananSeeder');
        $this->call('PengumumanSeeder');
        $this->call('MonitoringSeeder');
    }
}
