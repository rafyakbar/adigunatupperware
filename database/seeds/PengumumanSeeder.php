<?php

use Illuminate\Database\Seeder;

class PengumumanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(\App\Pengumuman::class, 50)->create()->each(function ($u){
            $u->make();
        });
    }
}
