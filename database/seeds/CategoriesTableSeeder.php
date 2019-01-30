<?php

use Faker\Factory;
use Illuminate\Database\Seeder;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::table('categories')->delete();

        $faker      = Factory::create();
        $categories = collect();

        // Create fake categories collection
        for ($i = 0; $i < 20; $i++) {
            $categories->push(['name' => ucfirst($faker->words($nb = 3, $asText = true))]);
        }

        \DB::table('categories')->insert($categories->toArray());
    }
}
