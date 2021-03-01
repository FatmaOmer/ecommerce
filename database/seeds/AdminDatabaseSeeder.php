<?php

use App\Models\Admin;
use Illuminate\Database\Seeder;

class AdminDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Admin::create([
            'name'=>'laila',
            'email'=>'laila@gmail.com',
            'password'=> encrypt('123456'),



        ]);
    }
}
