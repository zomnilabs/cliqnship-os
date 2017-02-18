<?php

use Illuminate\Database\Seeder;

class OauthClientsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('oauth_clients')->delete();
        DB::table('oauth_clients')->insert([
            [
                'user_id'    => null,
                'name'       => 'Personal Access Client',
                'secret'     => 'SsMphTu4WWN8Lv0QkIS41J5g0KdBLtYhUdNvzjv2',
                'redirect'   => 'http://localhost/',
                'personal_access_client' => 1,
                'password_client'        => 0,
                'revoked'                => 0
            ],
            [
                'user_id'    => null,
                'name'       => 'Password Grant Client',
                'secret'     => 'JtOZP3K753R4WEtrkUuNWT4kaEOZ7ydW0TbFtiai',
                'redirect'   => 'http://localhost/',
                'personal_access_client' => 0,
                'password_client'        => 1,
                'revoked'                => 0
            ],
            [
                'user_id'    => 66,
                'name'       => 'dragonpay',
                'secret'     => 'YztWFo1LPZ6EqJ3TStANdDRNniBQmNE11cFJMpSC',
                'redirect'   => 'http://localhost/auth/callback',
                'personal_access_client' => 0,
                'password_client'        => 0,
                'revoked'                => 0
            ]
        ]);
    }
}
