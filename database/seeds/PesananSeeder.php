<?php

use Illuminate\Database\Seeder;

class PesananSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = \Faker\Factory::create();
        $users = \App\User::all();
        $barang = \App\Barang::all();
        foreach ($users as $user){
            for ($c = 0; $c < rand(3, 10); $c++){
                $pesanan = \App\Pesanan::create([
                    'user_id' => $user->id,
                    'nama_pelanggan' => $faker->name,
                    'nohp_pelanggan' => '08'.$faker->isbn10,
                    'email_pelanggan' => $faker->email,
                    'alamat_pelanggan' => $faker->address
                ]);
                for ($i = 0; $i < rand(3,10); $i++){
                    $barang = \App\Barang::find(rand(1,100));
                    if ($barang->stok > 0){
                        $jumlah = rand(1,$barang->stok);
                        $pesanan->barang()->attach($barang, [
                            'jumlah' => $jumlah
                        ]);
                        $barang->update([
                            'stok' => $barang->stok - $jumlah
                        ]);
                    }
                }
            }
        }
    }
}
