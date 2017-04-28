<?php

use Illuminate\Database\Seeder;

class ItemsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\Item::create([
            'name'  => 'Pouch: Medium',
        ]);

        \App\Models\Item::create([
            'name'  => 'Pouch: Large',
        ]);

        \App\Models\Item::create([
            'name'  => 'Waybill',
        ]);
    }
}
