<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

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
            'name' => 'SECTION SYSTEMES INFORMATION METIER',
            'login' => 'admin',
            'password' => bcrypt('trpt.sim2020.'),
            'role' => 'admin'
        ]);
    }
}
