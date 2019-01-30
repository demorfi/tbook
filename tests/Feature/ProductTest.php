<?php

namespace Tests\Feature;

use App\Contracts\{Category as CategoryContract, Product as ProductContract, User as UserContract};
use Tests\TestCase;

/**
 * Class ProductTest.
 *
 * @package Tests\Feature
 */
class ProductTest extends TestCase
{
    /**
     * Testing a list of products in category.
     */
    public function testProductsAreListSuccessfully()
    {
        $collect  = collect();
        $name     = ucfirst($this->faker->words($nb = 3, $asText = true));
        $category = factory(CategoryContract::class)->create(compact('name'));

        for ($i = 0; $i < 5; $i++) {
            $name    = ucfirst($this->faker->words($nb = 3, $asText = true));
            $product = factory(ProductContract::class)->create(compact('name'));
            $category->products()->attach($product->id);
            $collect->push(compact('name'));
        }

        $this->json('GET', '/api/categories/' . $category->id . '/products')
            ->assertStatus(200)
            ->assertJson(['data' => $collect->toArray()])
            ->assertJsonStructure(['data' => ['*' => ['id', 'name']]]);
    }

    /**
     * Verifying the creation of a product.
     */
    public function testsProductsAreCreatedSuccessfully()
    {
        $user     = factory(UserContract::class)->create();
        $token    = $user->generateToken();
        $name     = ucfirst($this->faker->words($nb = 3, $asText = true));
        $category = factory(CategoryContract::class)->create(compact('name'));

        $this->json(
            'POST',
            '/api/products',
            ['name' => $name, 'categories_ids' => [$category->id]],
            ['Authorization' => 'Bearer ' . $token]
        )
            ->assertStatus(201)
            ->assertJson(['data' => ['name' => $name, 'categories' => [$category->id]]]);
    }

    /**
     * Verifying the update of a product.
     */
    public function testsProductsAreUpdatedSuccessfully()
    {
        $user     = factory(UserContract::class)->create();
        $token    = $user->generateToken();
        $name     = ucfirst($this->faker->words($nb = 3, $asText = true));
        $category = factory(CategoryContract::class)->create(compact('name'));
        $product  = factory(ProductContract::class)->create(compact('name'));
        $category->products()->attach($product->id);

        $newName = ucfirst($this->faker->words($nb = 3, $asText = true));
        $this->json(
            'PUT',
            '/api/products/' . $product->id,
            ['name' => $newName, 'categories_ids' => [$category->id]],
            ['Authorization' => 'Bearer ' . $token]
        )
            ->assertStatus(200)
            ->assertJson(['data' => ['id' => $product->id, 'name' => $newName, 'categories' => [$category->id]]]);
    }

    /**
     * Test deletion product.
     */
    public function testsProductsAreDestroySuccessfully()
    {
        $user    = factory(UserContract::class)->create();
        $token   = $user->generateToken();
        $name    = ucfirst($this->faker->words($nb = 3, $asText = true));
        $product = factory(ProductContract::class)->create(compact('name'));

        $this->json('DELETE', '/api/products/' . $product->id, [], ['Authorization' => 'Bearer ' . $token])
            ->assertStatus(204);
    }
}
