<?php

namespace Database\Seeders;

use App\Models\Assujetti;
use App\Models\Selection;
use App\Imports\CsvImport;
use Illuminate\Database\Seeder;
use Maatwebsite\Excel\Facades\Excel;

class AssujettisSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        ini_set('memory_limit', -1);

        $result = Excel::toArray(new CsvImport, public_path('files/csv/assujettis.xlsx'));

        foreach ($result[0] as $key => $assujetti) {
            if ($key == 0) {
                continue;
            }
            $convocationFormat = \DB::getDriverName() === 'mysql' ? 'Y-m-d' : 'd-m-Y';
            $convocation = \Carbon\Carbon::instance(\PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($assujetti[6]));
            $centre_selection = explode(' ', $assujetti[7], 2);
            $centre = str_replace('/', '-', $centre_selection[0]);
            $centreSansCarac=str_replace('.', '',$centre_selection[0]);
            $centreDb=Selection::where('centre',$centreSansCarac)->first();

            $ville = $centreDb->ville ?? '';
            Assujetti::create([
                'cnie' => str_replace(' ', '', $assujetti[0]),
                'nom' => $assujetti[1],
                'sexe' => $assujetti[2],
                'adresse' => $assujetti[3],
                'commune' => $assujetti[4],
                'province' => $assujetti[5],
                'centre_selection' => str_replace('.', '', $centre),
                'ville_selection' => $ville,
                'convocation' => $convocation->format($convocationFormat),
                'selection' => str_replace('.', '', $assujetti[7]),
                'vers_selection_th' => $assujetti[8],
            ]);
        }

        if(\DB::getDriverName() === 'pgsql')
            \DB::select("SELECT SETVAL('assujettis_id_seq', (SELECT MAX(id) FROM assujettis));");
    }
}
