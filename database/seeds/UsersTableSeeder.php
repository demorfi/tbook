<?php

use Carbon\Carbon;
use Faker\Factory;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::table('users')->delete();

        $faker = Factory::create();
        $date  = Carbon::now();
        $users = collect(config('users'))->map(
            function ($user) use ($date) {
                return (array_merge(
                    $user,
                    [
                        'password'   => bcrypt($user['password']),
                        'created_at' => $date,
                        'updated_at' => $date
                    ]
                ));
            }
        );

        // Create fake user collection
        $password = bcrypt($users->first()['password']);
        for ($i = 0; $i < 5; $i++) {
            $users->push(
                [
                    'name'       => $faker->name,
                    'email'      => $faker->email,
                    'password'   => $password,
                    'created_at' => $date,
                    'updated_at' => $date
                ]
            );
        }

        \DB::table('users')->insert($users->toArray());
    }
}
