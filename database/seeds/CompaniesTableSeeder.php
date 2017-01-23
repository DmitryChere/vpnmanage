<?php

use Illuminate\Database\Seeder;

class CompaniesTableSeeder extends Seeder
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
                'name' => 'Apple',
                'quota' => 11000000000000,
            ],
            [
                'name' => 'Alibaba',
                'quota' => 1100000000000,
            ]
        ];

        DB::table('companies')->insert($data);
    }
}
