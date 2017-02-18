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

        for ($i = 0; $i < 50; $i++) {
            $user = \App\User::create([
                'account_id'    => uniqid(),
                'user_group_id' => 5,
                'email'         => $faker->email,
                'password'      => Hash::make('password'),
                'account_type'  => \App\User::TYPE_INDIVIDUAL
            ]);

            $user->profile()->create([
                'first_name'    => $faker->firstName,
                'last_name'     => $faker->lastName,
                'middle_name'   => $faker->lastName,
                'gender'        => 'male',
                'birthdate'     => $faker->date()
            ]);
        }

        for ($i = 0; $i < 10; $i++) {
            $user = \App\User::create([
                'account_id'    => uniqid(),
                'user_group_id' => 4,
                'email'         => 'rider'.$i.'@cliq.ph',
                'password'      => Hash::make('password'),
                'account_type'  => \App\User::TYPE_INDIVIDUAL
            ]);

            $user->profile()->create([
                'first_name'    => $faker->firstName,
                'last_name'     => $faker->lastName,
                'middle_name'   => $faker->lastName,
                'gender'        => 'male',
                'birthdate'     => $faker->date()
            ]);
        }

        for ($i = 0; $i < 2; $i++) {
            $user = \App\User::create([
                'account_id'    => uniqid(),
                'user_group_id' => 3,
                'email'         => 'dispatcher'.$i.'@cliq.ph',
                'password'      => Hash::make('password'),
                'account_type'  => \App\User::TYPE_INDIVIDUAL
            ]);

            $user->profile()->create([
                'first_name'    => $faker->firstName,
                'last_name'     => $faker->lastName,
                'middle_name'   => $faker->lastName,
                'gender'        => 'male',
                'birthdate'     => $faker->date()
            ]);
        }

        for ($i = 0; $i < 2; $i++) {
            $user = \App\User::create([
                'account_id'    => uniqid(),
                'user_group_id' => 2,
                'email'         => 'staff'.$i.'@cliq.ph',
                'password'      => Hash::make('password'),
                'account_type'  => \App\User::TYPE_INDIVIDUAL
            ]);

            $user->profile()->create([
                'first_name'    => $faker->firstName,
                'last_name'     => $faker->lastName,
                'middle_name'   => $faker->lastName,
                'gender'        => 'male',
                'birthdate'     => $faker->date()
            ]);
        }

        $user = \App\User::create([
            'account_id'    => uniqid(),
            'user_group_id' => 1,
            'email'         => 'admin@cliq.ph',
            'password'      => Hash::make('password'),
            'account_type'  => \App\User::TYPE_INDIVIDUAL
        ]);

        $user->profile()->create([
            'first_name'    => $faker->firstName,
            'last_name'     => $faker->lastName,
            'middle_name'   => $faker->lastName,
            'gender'        => 'male',
            'birthdate'     => $faker->date()
        ]);

        $dragonpay = \App\User::create([
            'account_id'    => uniqid(),
            'user_group_id' => 5,
            'email'         => 'dragonpay@cliq.ph',
            'password'      => Hash::make('password'),
            'account_type'  => \App\User::TYPE_COMPANY
        ]);

        $dragonpay->profile()->create([
            'first_name'    => 'dragonpay',
            'last_name'     => 'dragonpay',
            'middle_name'   => 'dragonpay',
            'gender'        => 'male',
            'company_name'  => 'dragonpay',
            'birthdate'     => $faker->date()
        ]);

    }
}
