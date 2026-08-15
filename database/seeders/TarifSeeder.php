<?php

namespace Database\Seeders;

use App\Imports\CsvImport;
use App\Models\Tarif;
use Illuminate\Database\Seeder;
use Maatwebsite\Excel\Facades\Excel;

class TarifSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $result = Excel::toArray(new CsvImport, public_path('files/csv/tarif.xlsx'));

        foreach ($result[0] as $key => $tarif) {
            if($key == 0) {
                continue;
            }

            Tarif::create([
                'ville_depart' => $tarif[0],
                'ville_arrivee' => $tarif[1],
                'prix_oncf' => $tarif[2],
                'prix_car' => $tarif[3],
            ]);
        }

        if (\DB::getDriverName() === 'pgsql') {
            \DB::select("SELECT SETVAL('villes_id_seq', (SELECT MAX(id) FROM villes));");
        }
    }
}
