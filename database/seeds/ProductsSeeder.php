<?php

use Illuminate\Database\Seeder;
use App\Models\Products;
use Carbon\Carbon;

class ProductsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Products::insert([
            'name' => 'Coca cola',
            'category_id' =>  '1',
            'description' =>  'Inumin',
            'expiration_date' => Carbon::now()->format('Y-m-d H:i:s'),
        ]);
        Products::insert([
            'name' => 'Kita Kat',
            'category_id' =>  '2',
            'description' =>  'Chocolate',
            'expiration_date' => Carbon::now()->format('Y-m-d H:i:s'),
        ]);
        Products::insert([
            'name' => 'Gardenia',
            'category_id' =>  '3',
            'description' =>  'tinapay',
            'expiration_date' => Carbon::now()->format('Y-m-d H:i:s'),
        ]);
    }
}
