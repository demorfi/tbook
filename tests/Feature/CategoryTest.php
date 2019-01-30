<?php

namespace Tests\Feature;

use App\Contracts\{Category as CategoryContract, User as UserContract};
use Tests\TestCase;

/**
 * Class CategoryTest.
 *
 * @package Tests\Feature
 */
class CategoryTest extends TestCase
{
    /**
     * Testing a list of categories.
     */
    public function testCategoriesAreListSuccessfully()
    {
        $collect = collect();

        for ($i = 0; $i < 5; $i++) {
            $name = ucfirst($this->faker->words($nb = 3, $asText = true));
            factory(CategoryContract::class)->create(compact('name'));
            $collect->push(compact('name'));
        }

        $this->json('GET', '/api/categories')
            ->assertStatus(200)
            ->assertJson(['data' => $collect->toArray()])
            ->assertJsonStructure(['data' => ['*' => ['id', 'name', 'products_path']]]);
    }

    /**
     * Verifying the creation of a category.
     */
    public function testsCategoriesAreCreatedSuccessfully()
    {
        $user  = factory(UserContract::class)->create();
        $token = $user->generateToken();
        $name  = ucfirst($this->faker->words($nb = 3, $asText = true));

        $this->json('POST', '/api/categories', compact('name'), ['Authorization' => 'Bearer ' . $token])
            ->assertStatus(201)
            ->assertJson(['data' => compact('name')]);
    }

    /**
     * Verifying the update of a category.
     */
    public function testsCategoriesAreUpdatedSuccessfully()
    {
        $user     = factory(UserContract::class)->create();
        $token    = $user->generateToken();
        $name     = ucfirst($this->faker->words($nb = 3, $asText = true));
        $category = factory(CategoryContract::class)->create(compact('name'));
        $newName  = ucfirst($this->faker->words($nb = 3, $asText = true));

        $this->json(
            'PUT',
            '/api/categories/' . $category->id,
            ['name' => $newName],
            ['Authorization' => 'Bearer ' . $token]
        )
            ->assertStatus(200)
            ->assertJson(['data' => ['id' => $category->id, 'name' => $newName]]);
    }

    /**
     * Test deletion category.
     */
    public function testsCategoriesAreDestroySuccessfully()
    {
        $user     = factory(UserContract::class)->create();
        $token    = $user->generateToken();
        $name     = ucfirst($this->faker->words($nb = 3, $asText = true));
        $category = factory(CategoryContract::class)->create(compact('name'));

        $this->json('DELETE', '/api/categories/' . $category->id, [], ['Authorization' => 'Bearer ' . $token])
            ->assertStatus(204);
    }
}
