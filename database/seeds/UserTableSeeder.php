<?php

use Illuminate\Database\Seeder;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('user')->insert([
            'username' => 'yfancc20',
            'email' => 'jameswu1212@gmail.com',
            'password' => bcrypt('passy'),
        ]);

        DB::table('user')->insert([
            'username' => 'Cindyy',
            'email' => 'cindy123@gmail.com',
            'password' => bcrypt('passc'),
        ]);

        DB::table('user')->insert([
            'username' => 'Applejuice',
            'email' => 'applenice@gmail.com',
            'password' => bcrypt('passa'),
        ]);
    }
}
