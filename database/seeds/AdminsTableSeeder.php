<?php

use Illuminate\Database\Seeder;

class AdminsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        factory('App\AdminUser', 3)->create([
            'password' => bcrypt('123456')
        ]);
    }
}
