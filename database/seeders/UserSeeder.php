<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => 'tewodros yesmaw',
            'role' => 1,
            'email' => 'tewodros.yesmaw@cbe.com.et',
            'password' => bcrypt('password')
        ]);

        User::create([
            'name' => 'genet chanyalew',
            'role' => 2,
            'unit' => '04',
            'email' => 'genetchanyalew@cbe.com.et',
            'password' => bcrypt('password')
        ]);

        User::create([
            'name' => 'abebe kebede',
            'role' => 3,
            'email' => 'abebekebede@cbe.com.et',
            'password' => bcrypt('password')
        ]);

        User::create([
            'name' => 'tariku abera',
            'role' => 4,
            'email' => 'tarikuabera@cbe.com.et',
            'password' => bcrypt('password')
        ]);

        User::create([
            'name' => 'mikiyas alemu',
            'role' => 5,
            'email' => 'mikiyasalemu@cbe.com.et',
            'password' => bcrypt('password')
        ]);

        User::create([
            'name' => 'new user',
            'role' => 5,
            'email' => 'newuser@cbe.com.et',
            'password' => bcrypt('password')
        ]);

        User::create([
            'name' => 'ayele mamo',
            'role' => 6,
            'email' => 'ayelemamo@cbe.com.et',
            'password' => bcrypt('password')
        ]);
    }
}
