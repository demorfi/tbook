<?php

namespace Tests\Feature\Feature;

use App\Contracts\User as UserContract;
use Tests\TestCase;

/**
 * Class LogoutTest.
 *
 * @package Tests\Feature\Feature
 */
class LogoutTest extends TestCase
{
    /**
     * Verification of the possibility to reset authentication.
     */
    public function testUserIsLogoutProperly()
    {
        $user  = factory(UserContract::class)->create(['email' => $this->faker->email]);
        $token = $user->generateToken();

        $this->json('post', '/api/logout', [], ['Authorization' => 'Bearer ' . $token])
            ->assertStatus(200);
        $this->assertEquals(null, UserContract::find($user->id)->api_token);
    }
}
