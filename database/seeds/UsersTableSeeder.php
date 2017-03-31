<?php

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
        $faker = Faker\Factory::create();

        $user = \App\User::create([
            'account_id'    => uniqid(),
            'user_group_id' => 1,
            'email'         => 'admin@cliq.ph',
            'password'      => Hash::make('password'),
            'account_type'  => 'individual'
        ]);

        $user->profile()->create([
            'first_name'    => $faker->firstName,
            'last_name'     => $faker->lastName,
            'middle_name'   => $faker->lastName,
            'gender'        => 'male',
            'birthdate'     => $faker->date()
        ]);
    }
}
