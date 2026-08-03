<?php

namespace Database\Seeders;

use App\Imports\CsvImport;
use App\Models\Selection;
use Illuminate\Database\Seeder;
use Maatwebsite\Excel\Facades\Excel;

class SelectionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $result = Excel::toArray(new CsvImport, public_path('files/csv/selections.xlsx'));

        foreach ($result[0] as $key => $centre) {
            Selection::create([
                'centre' => str_replace(' ', '', $centre[0]),
                'ville' => $centre[1],
            ]);
        }

        \DB::select("SELECT SETVAL('selections_id_seq', (SELECT MAX(id) FROM selections));");
    }
}
