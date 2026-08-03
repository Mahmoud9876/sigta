<?php

namespace Database\Seeders;

use App\Imports\CsvImport;
use App\Models\Ville;
use Illuminate\Database\Seeder;
use Maatwebsite\Excel\Facades\Excel;

class VilleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $result = Excel::toArray(new CsvImport, public_path('files/csv/ville.xlsx'));

        foreach ($result[0] as $key => $ville) {
            if($key == 0) {
                continue;
            }

            Ville::create([
                'ville' => $ville[0],
            ]);
        }

        if (\DB::getDriverName() === 'pgsql') {
            \DB::select("SELECT SETVAL('villes_id_seq', (SELECT MAX(id) FROM villes));");
        }
    }
}
