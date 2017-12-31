<?php

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| Here you may define all of your model factories. Model factories give
| you a convenient way to create models for testing and seeding your
| database. Just tell the factory how a default model should look.
|
*/

/** @var \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(App\User::class, function (Faker\Generator $faker) {
    static $password;

    return [
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'password' => $password ?: $password = bcrypt('secret'),
        'remember_token' => str_random(10),
    ];
});

$factory->define(App\Barang::class, function (Faker\Generator $faker) {
    return [
        'kategori_id' => rand(1,count(KategoriSeeder::KATEGORI)),
        'kode' => str_random(5),
        'nama' => $faker->text(25),
        'keterangan' => $faker->text(100),
        'harga' => rand(10, 500) * 1000,
        'stok' => rand(0, 200),
        'dihapus' => false,
        'created_at' => $faker->dateTimeThisYear()
    ];
});

$factory->define(App\Pengumuman::class, function (Faker\Generator $faker) {
    return [
        'judul' => $faker->text(50),
        'keterangan' => $faker->text(500),
        'tampilkan' => rand(0,1)
    ];
});

$factory->define(App\Monitoring::class, function (Faker\Generator $faker) {
    return [
        'user_id' => rand(1, \App\User::count()),
        'menu' => \App\Monitoring::MENU[rand(0, count(\App\Monitoring::MENU) - 1)],
        'keterangan' => $faker->text
    ];
});