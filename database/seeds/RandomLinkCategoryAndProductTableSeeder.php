<?php

use App\Contracts\Category as CategoryContract;
use App\Contracts\Product as ProductContract;
use Faker\Factory;
use Illuminate\Database\Seeder;

class RandomLinkCategoryAndProductTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::table('category_products')->delete();

        $faker      = Factory::create();
        $categories = CategoryContract::pluck('id')->all();
        $linked     = collect();

        collect(ProductContract::pluck('id')->all())->map(
            function ($productId) use ($faker, $categories, $linked) {
                collect($faker->randomElements($categories, rand(1, 2)))->map(
                    function ($categoryId) use ($productId, $linked) {
                        $linked->push(['category_id' => $categoryId, 'product_id' => $productId]);
                    }
                );
            }
        );

        \DB::table('category_products')->insert($linked->toArray());
    }
}
