<?php

namespace Tests\Feature\Feature;

use App\Contracts\User as UserContract;
use Tests\TestCase;

/**
 * Class LoginTest.
 *
 * @package Tests\Feature\Feature
 */
class LoginTest extends TestCase
{
    /**
     * Check the mandatory filling of fields Email and Login.
     */
    public function testRequiresEmailAndLogin()
    {
        $this->json('POST', 'api/login')
            ->assertStatus(422)
            ->assertJson(
                [
                    'message' => 'The given data was invalid.',
                    'errors'  => [
                        'email'    => ['The email field is required.'],
                        'password' => ['The password field is required.']
                    ],
                ]
            );
    }

    /**
     * Verify Authentication Capability.
     */
    public function testUserLoginSuccessfully()
    {
        $email    = $this->faker->email;
        $password = $this->faker->password;

        factory(UserContract::class)->create(
            [
                'email'    => $email,
                'password' => bcrypt($password),
            ]
        );

        $this->json('POST', 'api/login', compact('email', 'password'))
            ->assertStatus(200)
            ->assertJsonStructure(
                [
                    'data' => [
                        'id',
                        'name',
                        'email',
                        'created_at',
                        'updated_at',
                        'api_token',
                    ],
                ]
            );

    }
}
