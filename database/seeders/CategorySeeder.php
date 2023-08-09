<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        
        DB::table('categories')->insert([
                'name' => 'Mobile Phones'
        ]);

        DB::table('categories')->insert([
            'name' => 'Vehicles'
        ]);

        DB::table('categories')->insert([
            'name' => 'Laptops'
        ]);

        DB::table('categories')->insert([
            'name' => 'Gaming Consoles'
        ]);

        DB::table('categories')->insert([
            'name' => 'Television Sets'
        ]);

    }
}
