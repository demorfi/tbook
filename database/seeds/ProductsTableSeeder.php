<?php

use Faker\Factory;
use Illuminate\Database\Seeder;

class ProductsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::table('products')->delete();

        $faker    = Factory::create();
        $products = collect();

        // Create fake categories collection
        for ($i = 0; $i < 200; $i++) {
            $products->push(['name' => ucfirst($faker->words($nb = 3, $asText = true))]);
        }

        \DB::table('products')->insert($products->toArray());
    }
}
