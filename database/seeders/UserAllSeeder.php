<?php

namespace Database\Seeders;

use App\Imports\CsvImport;
use App\Models\Assujetti;
use App\Models\User;
use Illuminate\Database\Seeder;
use Maatwebsite\Excel\Facades\Excel;

class UserAllSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $result = Excel::toArray(new CsvImport, public_path('files/csv/users.xlsx'));

        foreach ($result[0] as $key => $assujetti) {
            if($key == 0) {
                continue;
            }
            User::create([
                'name' => $assujetti[0],
                'login' => $assujetti[1],
                'login' => $assujetti[2],
                'centre' => $assujetti[3],
                'role' => $assujetti[4],
                'password' => $assujetti[5],
                'remember_token' => $assujetti[6],
            ]);
        }

        if(\DB::getDriverName() === 'pgsql')
            \DB::select("SELECT SETVAL('users_id_seq', (SELECT MAX(id) FROM users));");
    }
}
