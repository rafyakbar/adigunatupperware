<?php

use Illuminate\Database\Seeder;
use App\Kategori;

class KategoriSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */

    const KATEGORI = [
        'Botol', 'Tempat makan', 'Lain-lain'
    ];

    public function run()
    {
        foreach (static::KATEGORI as $item){
            Kategori::create([
                'nama' => $item
            ]);
        }
    }
}
