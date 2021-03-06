<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(OauthClientsTableSeeder::class);
        $this->call(SourcesTableSeeder::class);
        $this->call(UserGroupsTableSeeder::class);
        $this->call(UsersTableSeeder::class);
        $this->call(ItemsTableSeeder::class);
    }
}
