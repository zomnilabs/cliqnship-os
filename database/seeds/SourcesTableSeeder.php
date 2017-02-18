<?php

use Illuminate\Database\Seeder;

class SourcesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\Source::create([
            'name'  => 'Over The Phone',
            'slug'  => 'over-the-phone'
        ]);

        \App\Models\Source::create([
            'name'  => 'Website',
            'slug'  => 'website'
        ]);

        \App\Models\Source::create([
            'name'  => 'App',
            'slug'  => 'app'
        ]);

        \App\Models\Source::create([
            'name'  => 'Partner',
            'slug'  => 'partner'
        ]);
    }
}
