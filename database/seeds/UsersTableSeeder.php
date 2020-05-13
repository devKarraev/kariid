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
                'name'     => 'admin',
                'password' => bcrypt('123'),
            ],
        ];

        \DB::table('users')->insert($data);
    }
}
