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
        $data = [
            [
                'name' => 'John',
                'email' => 'John@doe.com',
                'password' => bcrypt('secret'),
                'company_id' => 2
            ],
            [
                'name' => 'Jane',
                'email' => 'Jane@doe.com',
                'password' => bcrypt('secret'),
                'company_id' => 2
            ],
            [
                'name' => 'Jim',
                'email' => 'jim@doe.com',
                'password' => bcrypt('secret'),
                'company_id' => 1
            ],
            [
                'name' => 'Richard',
                'email' => 'richard@apple.com',
                'password' => bcrypt('secret'),
                'company_id' => 1
            ],
            [
                'name' => 'Picasso',
                'email' => 'picasso@apple.com',
                'password' => bcrypt('secret'),
                'company_id' => 1
            ]
        ];

        DB::table('users')->insert($data);
    }
}
