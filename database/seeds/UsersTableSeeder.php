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
            'name' => 'Mr. Admin',
            'role_id' => 1,
            'username' => 'admin',
            'email' => 'admin@blog.com',
            'password' => bcrypt('123456'),
        ]);
        DB::table('users')->insert([
            'name' => 'Mr. Author',
            'role_id' => 2,
            'username' => 'author',
            'email' => 'author@blog.com',
            'password' => bcrypt('123456'),
        ]);
    }
}
