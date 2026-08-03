<?php

namespace Database\Seeders;

use App\Imports\CsvImport;
use App\Models\Centre;
use Illuminate\Database\Seeder;
use Maatwebsite\Excel\Facades\Excel;

class CentreSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $result = Excel::toArray(new CsvImport, public_path('files/csv/centres.xlsx'));

        foreach ($result[0] as $key => $centre) {
            if($key == 0) {
                continue;
            }

            Centre::create([
                'centre' => str_replace(' ', '', $centre[0]),
                'ville' => $centre[1],
                'inspection' => $centre[2],
                'feminin' => $centre[3],
                'masculin' => $centre[4],
                'total' => $centre[5],
            ]);
        }

        \DB::select("SELECT SETVAL('centres_id_seq', (SELECT MAX(id) FROM centres));");
    }
}
