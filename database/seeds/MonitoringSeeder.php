<?php

use Illuminate\Database\Seeder;

class MonitoringSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(\App\Monitoring::class, 50)->create()->each(function ($u){
            $u->make();
        });
    }
}
