<?php

use Illuminate\Database\Seeder;

class AuthSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('user')->insert([
            'nama' => 'IT',
            'email' => 'it@cwabali.com',
            'email_verified_at' => NOW(),
            'password' => bcrypt('1sampai9'),
            'dep' => 'IT'
        ]);
    }
}
