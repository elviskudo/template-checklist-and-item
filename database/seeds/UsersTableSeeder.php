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
        DB::table('users')->insert([
            'name' => 'Elvis Sonatha',
            'email' => 'elviskudo@gmail.com',
            'password' => app('hash')->make('elvis'),
        ]);
    }
}
