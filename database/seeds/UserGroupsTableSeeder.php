<?php

use Illuminate\Database\Seeder;

class UserGroupsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\UserGroup::create([
            'name'  => 'Admin',
            'slug'  => 'admin'
        ]);

        \App\Models\UserGroup::create([
            'name'  => 'Staff',
            'slug'  => 'staff'
        ]);

        \App\Models\UserGroup::create([
            'name'  => 'Dispatcher',
            'slug'  => 'dispatcher'
        ]);

        \App\Models\UserGroup::create([
            'name'  => 'Rider',
            'slug'  => 'rider'
        ]);

        \App\Models\UserGroup::create([
            'name'  => 'Customer',
            'slug'  => 'customer'
        ]);
    }
}
