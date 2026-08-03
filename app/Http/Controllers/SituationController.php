<?php

namespace App\Http\Controllers;

use App\Models\Assujetti;
use App\Models\Centre;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SituationController extends Controller
{

    public function index()
    {
        return view('situations.index');
    }
    public function globale()
    {
        if (Auth::user()->isSelection()) {
            $selection_assujettis = Assujetti::where('selection', 'like', '%' . Auth::user()->centre . '%')->get()->groupBy('centre_selection');
        } else {
            $selection_assujettis = Assujetti::all()->groupBy('centre_selection');
        }
        $centres = Centre::all();

        //for chart
        $centreArray = array();
        $c_convoque = array();
        $c_presente = array();
        $c_admis = array();
        foreach ($selection_assujettis as $centre => $assujettis) {
            $centreArray[] = $centre;
            $c_convoque[] = $selection_assujettis[$centre]->count();
            $c_presente[] = $selection_assujettis[$centre]->whereNotNull('presentation')->count();
            $c_admis[] = $selection_assujettis[$centre]->where('admis', true)->count();

        }

        return view('situations.globale.index', compact('selection_assujettis', 'centres', 'centreArray',
            'c_convoque', 'c_presente', 'c_admis'));
    }

    public function journaliere(Request $request)
    {
        $all = Assujetti::all()->groupBy('centre_selection');
        // dd($all);
        if ($request->date) {
            if (Auth::user()->isSelection()) {
                $selection_assujettis = Assujetti::where('selection', 'like', '%' . Auth::user()->centre . '%')
                    ->where('presentation', $request->date)->get()->groupBy('centre_selection');
                $selection_assujettis_pratique = Assujetti::where('selection', 'like', '%' . Auth::user()->centre . '%')
                    ->where('convocation', $request->date)->get()->groupBy('centre_selection');
            } else {
                $selection_assujettis = Assujetti::where('selection', 'like', '%' . Auth::user()->centre . '%')
                    ->where('presentation', $request->date)->get()->groupBy('centre_selection');
                $selection_assujettis_pratique = Assujetti::where('selection', 'like', '%' . Auth::user()->centre . '%')
                    ->where('convocation', $request->date)->get()->groupBy('centre_selection');
            }
        } else {
            if (Auth::user()->isSelection()) {
                $selection_assujettis = Assujetti::where('selection', 'like', '%' . Auth::user()->centre . '%')
                    ->where('presentation', today())->get()->groupBy('centre_selection');
                $selection_assujettis_pratique = Assujetti::where('convocation', today())->get()->groupBy('centre_selection');
            } else {
                $selection_assujettis = Assujetti::where('presentation', today())->get()->groupBy('centre_selection');
                $selection_assujettis_pratique = Assujetti::where('convocation', today())->get()->groupBy('centre_selection');
            }
        }
        $centres = Centre::all();

        $centreArray = array();
        $c_convoque = array();
        $c_presente = array();
        $c_admis = array();
        foreach ($all as $centre => $assujettis) {
            $centreArray[] = $centre;
            if ($selection_assujettis->has($centre)) {
                $c_presente[] = $selection_assujettis[$centre]->whereNotNull('presentation')->count();
                $c_admis[] = $selection_assujettis[$centre]->where('admis', true)->count();

            } else {
                $c_presente[] = 0;
                $c_admis[] = 0;

            }
            if ($selection_assujettis_pratique->has($centre)) {
                $c_convoque[] = $selection_assujettis_pratique[$centre]->count();

            } else {
                $c_convoque[] = 0;

            }
            // $c_admis[] = $selection_assujettis[$centre]->where('admis', true)->count();
        }
        // foreach ($selection_assujettis_pratique as $key => $selectionAssujettis) {
        //     $c_convoque[] = $selection_assujettis_pratique[$key]->count();
        // }

        return view('situations.journaliere.index', compact('all', 'selection_assujettis', 'selection_assujettis_pratique',
            'centres', 'centreArray',
            'c_convoque', 'c_presente', 'c_admis'));
    }

    public function coupons(Request $request)
    {
        $centres = Centre::all();
        $t_sntl = [];
        $t_oncf = [];
        if (Auth::user()->isSelection()) {
            if ($request->date) {
                $selection_assujettis = Assujetti::where('selection', 'like', '%' . Auth::user()->centre . '%')->where('convocation', $request->date)->get()->groupBy('centre_selection');
                $selection_assujettis_pratique = Assujetti::where('selection', 'like', '%' . Auth::user()->centre . '%')->where('presentation', $request->date)
                    ->where('coupons', true)->get()->groupBy('centre_selection');
                $theorique = Assujetti::where('selection', 'like', '%' . Auth::user()->centre . '%')->where('convocation', $request->date)->count();
                $utilise = Assujetti::where('selection', 'like', '%' . Auth::user()->centre . '%')->where('convocation', $request->date)->where('coupons', true)->count();
            } else {
                $selection_assujettis = Assujetti::where('selection', 'like', '%' . Auth::user()->centre . '%')->get()->groupBy('centre_selection');
                $selection_assujettis_pratique = Assujetti::where('selection', 'like', '%' . Auth::user()->centre . '%')->where('coupons', true)->get()->groupBy('centre_selection');
                $theorique = Assujetti::where('selection', 'like', '%' . Auth::user()->centre . '%')->count();
                $utilise = Assujetti::where('selection', 'like', '%' . Auth::user()->centre . '%')->where('coupons', true)->count();
            }
        } else {
            if ($request->date) {
                $selection_assujettis = Assujetti::where('convocation', $request->date)->get()->groupBy('centre_selection');
                $selection_assujettis_pratique = Assujetti::where('presentation', $request->date)
                    ->where('coupons', true)->get()->groupBy('centre_selection');
                $theorique = Assujetti::where('convocation', $request->date)->count();
                $utilise = Assujetti::where('convocation', $request->date)->where('coupons', true)->count();
            } else {
                $selection_assujettis = Assujetti::all()->groupBy('centre_selection');
                $selection_assujettis_pratique = Assujetti::where('coupons', true)->get()->groupBy('centre_selection');
                $theorique = Assujetti::count();
                $utilise = Assujetti::where('coupons', true)->count();
            }
        }
        // pour chart
        $centreArray = array();
        $c_utilise = array();
        $c_theorique = array();
        $montantSNTL = array();
        $montantOncf = array();
        $total = array();
        foreach ($selection_assujettis as $centre => $assujettis) {
            $centreArray[] = $centre;
            $c_utilise[] = $selection_assujettis_pratique->has($centre) ? $selection_assujettis_pratique->get($centre)->count() : 0;
            $c_theorique[] = $assujettis->count();
            $montantOncf[] = $selection_assujettis_pratique->has($centre) ? $oncf = $selection_assujettis_pratique->get($centre)
                ->where('vers_selection', 'ONCF')
                ->sum('prix') : 0;
            $montantSNTL[] = $selection_assujettis_pratique->has($centre) ? $sntl = $selection_assujettis_pratique->get($centre)
                ->where('vers_selection', 'CAR DE LIGNE')
                ->sum('prix') : 0;
            $total[] = $selection_assujettis_pratique->has($centre) ? $sntl + $oncf : 0;
        }
        // dd($centreArray, $montantOncf, $montantSNTL,$total);
        return view('situations.coupons.index', compact('centres', 'selection_assujettis',
            'selection_assujettis_pratique', 't_sntl', 't_oncf', 'theorique', 'utilise'
            , 'centreArray', 'c_utilise', 'c_theorique', 'montantOncf', 'montantSNTL', 'total'));
    }

    public function moyen_transports(Request $request)
    {
        $centres = Centre::all();
        $t_c_sntl = [];
        $t_c_oncf = [];
        $t_navette = [];
        $t_pm = [];
        $t_c_sntl_th = [];
        $t_c_oncf_th = [];
        $t_navette_th = [];
        $t_pm_th = [];
        if (Auth::user()->isSelection()) {
            if ($request->date) {
//                $selection_assujettis = Assujetti::where('selection', 'like', '%'.Auth::user()->centre.'%' )->where('convocation', $request->date)->get()->groupBy('centre_selection');
//                $theorique = Assujetti::count();
            } else {
                $selection_assujettis = Assujetti::where('selection', 'like', '%' . Auth::user()->centre . '%')->get()->groupBy('centre_selection');

            }
        } else {
            if ($request->date) {
//                $selection_assujettis = Assujetti::where('convocation', $request->date)->get()->groupBy('centre_selection');
//                $theorique = Assujetti::count();
            } else {
                $selection_assujettis = Assujetti::all()->groupBy('centre_selection');
            }
        }

        $centreArray = array();
        $c_pm = array();
        $c_navette = array();
        $c_oncf = array();
        $c_sntl = array();
        foreach ($selection_assujettis as $centre => $assujettis) {
            $centreArray[] = $centre;
            $c_pm[] = $pm = $assujettis->where('vers_selection', 'PROPRE MOYEN')->count();
            $c_navette[] = $assujettis->where('vers_selection', 'NAVETTE')->count();
            $co_oncf[] = $assujettis->where('vers_selection', 'ONCF')->count();
            $co_sntl[] = $assujettis->where('vers_selection', 'CAR DE LIGNE')->count();
        }
        return view('situations.moyen_transports.index', compact('centres', 'selection_assujettis',
            't_c_sntl', 't_c_oncf', 't_navette', 't_pm', 't_c_sntl_th', 't_c_oncf_th',
            't_navette_th', 't_pm_th', 'c_pm', 'c_navette', 'co_oncf', 'co_sntl', 'centreArray'));
    }

    public function graphe_selection(Request $request)
    {
        if (Auth::user()->isSelection()) {
            if ($request->date) {
                $theorique = Assujetti::where('selection', 'like', '%' . Auth::user()->centre . '%')
                    ->where('convocation', $request->date)
                    ->get()
                    ->groupBy('vers_selection_th');

                $pratique = Assujetti::where('selection', 'like', '%' . Auth::user()->centre . '%')
                    ->where('presentation', $request->date)
                    ->get()
                    ->groupBy('vers_selection');
                return view('situations.graphs.selection.index', compact('pratique', 'theorique'));
            }
            $theorique = Assujetti::where('selection', 'like', '%' . Auth::user()->centre . '%')
                ->where('convocation', now())
                ->get()
                ->groupBy('vers_selection_th');

            $pratique = Assujetti::where('selection', 'like', '%' . Auth::user()->centre . '%')
                ->where('presentation', now())
                ->get()
                ->groupBy('vers_selection');

            return view('situations.graphs.selection.index', compact('pratique', 'theorique'));
        }

        if ($request->date) {
            $theorique = Assujetti::where('convocation', $request->date)
                ->get()
                ->groupBy('vers_selection_th');

            $pratique = Assujetti::where('presentation', $request->date)
                ->get()
                ->groupBy('vers_selection');

            return view('situations.graphs.selection.index', compact('pratique', 'theorique'));
        }
        $pratique = Assujetti::where('presentation', now())
            ->get()
            ->groupBy('vers_selection');

        $theorique = Assujetti::where('convocation', now())
            ->get()
            ->groupBy('vers_selection_th');

        return view('situations.graphs.selection.index', compact('pratique', 'theorique'));
    }

    public function graphe_formation(Request $request)
    {
        if (Auth::user()->isSelection()) {
            if ($request->date) {
                $pratique = Assujetti::where('selection', 'like', '%' . Auth::user()->centre . '%')
                    ->where('presentation', $request->date)
                    ->get()
                    ->groupBy('vers_formation');

                return view('situations.graphs.formation.index', compact('pratique'));
            }
            $pratique = Assujetti::where('selection', 'like', '%' . Auth::user()->centre . '%')
                ->where('presentation', now())
                ->get()
                ->groupBy('vers_formation');

            return view('situations.graphs.formation.index', compact('pratique'));
        }

        if ($request->date) {
            $pratique = Assujetti::where('presentation', $request->date)
                ->get()
                ->groupBy('vers_formation');

            return view('situations.graphs.formation.index', compact('pratique'));
        }
        $pratique = Assujetti::where('presentation', now())
            ->get()
            ->groupBy('vers_formation');

        return view('situations.graphs.formation.index', compact('pratique'));
    }
    
public function situationGenerale(Request $request)
{


    $effTheoriqueNow=Assujetti::where('convocation', now())->count();
    $effPresenteNow=Assujetti::where('presentation', now())->count();
    $effAdmisNow=Assujetti::where('presentation', now())->where('admis',true)->count();
    $effAbsentNow=$effTheoriqueNow- $effPresenteNow;

    $moyenCarUtilise=Assujetti::where('presentation', now())->where('vers_selection','CAR DE LIGNE')->count();
    $moyenNavetteUtilise=Assujetti::where('presentation', now())->where('vers_selection','NAVETTE')->count();
    $moyenOncfUtilise=Assujetti::where('presentation', now())->where('vers_selection','ONCF')->count();
    $moyenPropreMoyenUtilise=Assujetti::where('presentation', now())->where('vers_selection','PROPRE MOYEN')->count();


    // CAR
    $moyenCarPrevuCar=Assujetti::where('presentation', now())->where('vers_selection','CAR DE LIGNE')
    ->where('vers_selection_th','CAR DE LIGNE')->count();
    $moyenCarPrevuNavette=Assujetti::where('presentation', now())->where('vers_selection','CAR DE LIGNE')
    ->where('vers_selection_th','NAVETTE')->count();
    $moyenCarPrevuOncf=Assujetti::where('presentation', now())->where('vers_selection','CAR DE LIGNE')
    ->where('vers_selection_th','ONCF')->count();
    $moyenCarPrevuPropreMoyen=Assujetti::where('presentation', now())->where('vers_selection','CAR DE LIGNE')
    ->where('vers_selection_th','PROPRE MOYEN')->count();

    //Navette
    $moyenNavettePrevuNavette=Assujetti::where('presentation', now())->where('vers_selection','NAVETTE')
    ->where('vers_selection_th','NAVETTE')->count();
    $moyenNavettePrevuOncf=Assujetti::where('presentation', now())->where('vers_selection','NAVETTE')
    ->where('vers_selection_th','ONCF')->count();
    $moyenNavettePrevuCar=Assujetti::where('presentation', now())->where('vers_selection','NAVETTE')
    ->where('vers_selection_th','CAR DE LIGNE')->count();
    $moyenNavettePrevuPropreMoyen=Assujetti::where('presentation', now())->where('vers_selection','NAVETTE')
    ->where('vers_selection_th','PROPRE MOYEN')->count();

    //Oncf
    $moyenOncfPrevuNavette=Assujetti::where('presentation', now())->where('vers_selection','ONCF')
    ->where('vers_selection_th','NAVETTE')->count();
    $moyenOncfPrevuOncf=Assujetti::where('presentation', now())->where('vers_selection','ONCF')
    ->where('vers_selection_th','ONCF')->count();
    $moyenOncfPrevuCar=Assujetti::where('presentation', now())->where('vers_selection','ONCF')
    ->where('vers_selection_th','CAR DE LIGNE')->count();
    $moyenOncfPrevuPropreMoyen=Assujetti::where('presentation', now())->where('vers_selection','ONCF')
    ->where('vers_selection_th','PROPRE MOYEN')->count();

    //PROPRE MOYEN
    $moyenPropreMoyenPrevuNavette=Assujetti::where('presentation', now())->where('vers_selection','PROPRE MOYEN')
    ->where('vers_selection_th','NAVETTE')->count();
    $moyenPropreMoyenPrevuOncf=Assujetti::where('presentation', now())->where('vers_selection','PROPRE MOYEN')
    ->where('vers_selection_th','ONCF')->count();
    $moyenPropreMoyenPrevuCar=Assujetti::where('presentation', now())->where('vers_selection','PROPRE MOYEN')
    ->where('vers_selection_th','CAR DE LIGNE')->count();
    $moyenPropreMoyenPrevuPropreMoyen=Assujetti::where('presentation', now())->where('vers_selection','PROPRE MOYEN')
    ->where('vers_selection_th','PROPRE MOYEN')->count();


    //SITUATION GLOBALE

    $effTheoriqueGlobal=Assujetti::all()->count();
    $effPresenteGlobal=Assujetti::whereNotNull('presentation')->count();
    $effAdmisGlobal=Assujetti::where('admis',true)->count();


    $moyenCarUtiliseGlobal=Assujetti::where('vers_selection','CAR DE LIGNE')->count();
    $moyenNavetteUtiliseGlobal=Assujetti::where('vers_selection','NAVETTE')->count();
    $moyenOncfUtiliseGlobal=Assujetti::where('vers_selection','ONCF')->count();
    $moyenPropreMoyenUtiliseGlobal=Assujetti::where('vers_selection','PROPRE MOYEN')->count();

     // CAR
     $moyenCarPrevuCarGlobal=Assujetti::where('vers_selection','CAR DE LIGNE')
     ->where('vers_selection_th','CAR DE LIGNE')->count();
     $moyenCarPrevuNavetteGlobal=Assujetti::where('vers_selection','CAR DE LIGNE')
     ->where('vers_selection_th','NAVETTE')->count();
     $moyenCarPrevuOncfGlobal=Assujetti::where('vers_selection','CAR DE LIGNE')
     ->where('vers_selection_th','ONCF')->count();
     $moyenCarPrevuPropreMoyenGlobal=Assujetti::where('vers_selection','CAR DE LIGNE')
     ->where('vers_selection_th','PROPRE MOYEN')->count();

     //Navette
     $moyenNavettePrevuNavetteGlobal=Assujetti::where('vers_selection','NAVETTE')
     ->where('vers_selection_th','NAVETTE')->count();
     $moyenNavettePrevuOncfGlobal=Assujetti::where('vers_selection','NAVETTE')
     ->where('vers_selection_th','ONCF')->count();
     $moyenNavettePrevuCarGlobal=Assujetti::where('vers_selection','NAVETTE')
     ->where('vers_selection_th','CAR DE LIGNE')->count();
     $moyenNavettePrevuPropreMoyenGlobal=Assujetti::where('vers_selection','NAVETTE')
     ->where('vers_selection_th','PROPRE MOYEN')->count();

     //Oncf
     $moyenOncfPrevuNavetteGlobal=Assujetti::where('vers_selection','ONCF')
     ->where('vers_selection_th','NAVETTE')->count();
     $moyenOncfPrevuOncfGlobal=Assujetti::where('vers_selection','ONCF')
     ->where('vers_selection_th','ONCF')->count();
     $moyenOncfPrevuCarGlobal=Assujetti::where('vers_selection','ONCF')
     ->where('vers_selection_th','CAR DE LIGNE')->count();
     $moyenOncfPrevuPropreMoyenGlobal=Assujetti::where('vers_selection','ONCF')
     ->where('vers_selection_th','PROPRE MOYEN')->count();

     //PROPRE MOYEN
     $moyenPropreMoyenPrevuNavetteGlobal=Assujetti::where('vers_selection','PROPRE MOYEN')
     ->where('vers_selection_th','NAVETTE')->count();
     $moyenPropreMoyenPrevuOncfGlobal=Assujetti::where('vers_selection','PROPRE MOYEN')
     ->where('vers_selection_th','ONCF')->count();
     $moyenPropreMoyenPrevuCarGlobal=Assujetti::where('vers_selection','PROPRE MOYEN')
     ->where('vers_selection_th','CAR DE LIGNE')->count();
     $moyenPropreMoyenPrevuPropreMoyenGlobal=Assujetti::where('vers_selection','PROPRE MOYEN')
     ->where('vers_selection_th','PROPRE MOYEN')->count();



    return view('situations.pointSituation', compact(
    'moyenPropreMoyenPrevuPropreMoyenGlobal','moyenPropreMoyenPrevuCarGlobal',
    'moyenPropreMoyenPrevuOncfGlobal','moyenPropreMoyenPrevuNavetteGlobal',
    'moyenOncfPrevuPropreMoyenGlobal','moyenOncfPrevuCarGlobal',
    'moyenOncfPrevuOncfGlobal','moyenOncfPrevuNavetteGlobal',
    'moyenNavettePrevuPropreMoyenGlobal','moyenNavettePrevuCarGlobal',
    'moyenNavettePrevuOncfGlobal','moyenNavettePrevuNavetteGlobal',
    'moyenCarPrevuPropreMoyenGlobal','moyenCarPrevuOncfGlobal',
    'moyenCarPrevuNavetteGlobal','moyenCarPrevuCarGlobal',
    'effAdmisGlobal','effPresenteGlobal','effTheoriqueGlobal',
    'moyenPropreMoyenUtiliseGlobal','moyenOncfUtiliseGlobal',
    'moyenNavetteUtiliseGlobal','moyenCarUtiliseGlobal',
    'effTheoriqueGlobal','effPresenteGlobal','effAdmisGlobal',

    'moyenPropreMoyenPrevuPropreMoyen','moyenPropreMoyenPrevuCar',
    'moyenPropreMoyenPrevuOncf','moyenPropreMoyenPrevuNavette',
    'moyenOncfPrevuPropreMoyen','moyenOncfPrevuCar',
    'moyenOncfPrevuOncf','moyenOncfPrevuNavette',
    'moyenNavettePrevuPropreMoyen','moyenNavettePrevuCar',
    'moyenNavettePrevuOncf','moyenNavettePrevuNavette',
    'moyenCarPrevuPropreMoyen','moyenCarPrevuOncf',
    'moyenCarPrevuNavette','moyenCarPrevuCar',
    'moyenPropreMoyenUtilise','moyenOncfUtilise',
    'moyenNavetteUtilise','moyenCarUtilise',
    'effTheoriqueNow','effPresenteNow','effAdmisNow','effAbsentNow'
));

}

}
