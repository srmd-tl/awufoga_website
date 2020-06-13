<?php
use App\KeyType;
use Illuminate\Database\Seeder;

class KeyTypeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $keyTypes = [["title" => "Africa Talking"], ["title" => "Flutterwave"], ["title" => "Firebase"], ["title" => "Branch.IO"],["title"=>"Google Map"]];
        KeyType::insert($keyTypes);
    }
}
