<?php

use App\Admin;
use Illuminate\Database\Seeder;

class AdminTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $data = ["email" => "abdullahi@awufoga.com", "password" => bcrypt("admin@123"), "name" => "admin"];
        Admin::create($data);

    }
}
