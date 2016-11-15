<?php

use Illuminate\Database\Seeder;

class locationsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Location::class, 50)->create();
    }
}
