<?php

namespace App\Http\Controllers;

use App\Models\Ville;
use App\Models\Centre;
use App\Models\Assujetti;
use Illuminate\Http\Request;
use App\Events\AssujettiEvent;
use App\Events\FormationEvent;
use App\Events\TransportEvent;
use Illuminate\Support\Facades\Log;
use App\Http\Queries\AssujettiQuery;
use Illuminate\Support\Facades\Auth;

class AssujettiController extends Controller
{
    public function accueil(Request $request)
    {
        return view('home.index');

    }
    public function index(Request $request)
    {
        if ($request->ajax()) {

            return (new AssujettiQuery())->get();
        }

        $centres = Centre::all();
        $villes=Ville::all();
        if ($request->view == 'tablet' || empty($request->view)) {

            return view('assujettis.index', compact('centres','villes'));
        }

        if ($request->presentation) {
            if (Auth::user()->isSelection()) {
                $assujettis = Assujetti::where('presentation', $request->presentation)
                    ->where('selection', 'like', '%' . Auth::user()->centre . '%')
		    
			->get()->groupBy('selection');
echo 1;
            } else {
                $assujettis = Assujetti::where('presentation', $request->presentation)->get()->groupBy('selection');
echo 2;
            }
        } else {
            if (Auth::user()->isSelection()) {
                $assujettis = Assujetti::where('presentation', today())
                    ->where('selection', 'like', '%' . Auth::user()->centre . '%')
		
			->get()->groupBy('selection');
echo 3;
            } else {
                $assujettis = Assujetti::where('presentation', today())->get()->groupBy('selection');echo 4;
            }
        }

        return view('assujettis.details', compact('centres', 'assujettis'));
    }

    public function fields(Request $request)
    {
        $assujetti = Assujetti::find($request->id);
        if (empty($assujetti)) {
            return response()->json('ASSUJETTI NON TROUVÉ', 403);
        }

        $operation = $this->operation($assujetti, $request);
        $this->fireEvent($assujetti, $request, $operation);

        $assujetti->{$request->field} = $request->value;

        $assujetti->save();

 // Réinitialiser tous les champs si "ADMIS/INAPTE" est sélectionné
 if ($request->field == 'admis' && $request->value == '') {
    $assujetti->formation = null;
    $assujetti->transport = null;
    $assujetti->vers_formation = null;
    $assujetti->domicile = null;
    $assujetti->save();
    return response()->json(true);
}

// Si "INAPTE" est sélectionné, réinitialiser les champs spécifiques
if ($request->field == 'admis' && $request->value == '0') {
    $assujetti->formation = null;
    $assujetti->transport = null;
    $assujetti->vers_formation = null;
    $assujetti->save();
}

// Si "APTE" est sélectionné après "INAPTE", réinitialiser le champ "domicile"
if ($request->field == 'admis' && $request->value == '1' && !is_null($assujetti->domicile)) {
    $assujetti->domicile = null;
    $assujetti->save();
}



        if (empty($assujetti->{$request->field}) && !in_array($request->field, ['coupons', 'admis'])) {
            return response()->json(false);
        }

        if (in_array($request->field, ['coupons', 'ville_depart', 'ville_arrivee','prix'])) {
            if (($assujetti->coupons == true && $assujetti->ville_depart && $assujetti->ville_arrivee && $assujetti->prix) || $assujetti->coupons == false) {
                return response()->json(true);
            } else {
                return response()->json(false);
            }
        }

        return response()->json(true);
    }


    public function fireEvent(Assujetti $assujetti, Request $request, $operation)
    {
        switch ($request->field) {
            case 'admis':
                $message = 'Nouvelle admission au niveau ' . $assujetti->selection . ': ' . $assujetti->nom . ' (' . $assujetti->cnie . ')';
                event(new AssujettiEvent($message, 'admis', 'success', $operation, $assujetti->centre_selection));
                break;
            case 'presentation':
                if (!empty($assujetti->presentation) && !empty($request->value)) {
                    break;
                }
                $message = 'Nouveau candidat au niveau ' . $assujetti->selection . ': ' . $assujetti->nom . ' (' . $assujetti->cnie . ')';
                event(new AssujettiEvent($message, 'presentation', 'info', $operation, $assujetti->centre_selection));
                break;

            case 'formation':
                Log::info($request->value);
                $message = 'Nouvelle affectation de ' . $assujetti->selection . ' vers ' . $request->value . ': ' . $assujetti->nom . ' (' . $assujetti->cnie . ')';
                $mixte = $this->isMixte($request->value, $assujetti->sexe);
                if ($assujetti->formation) {
                    $old_id = $assujetti->centre_selection . '-' . $assujetti->formation;
                } else {
                    $old_id = null;
                }
                event(new FormationEvent($message, 'formation', 'default', $assujetti->centre_selection . '-' . $this->deleteSlash($request->value) . $mixte, $this->deleteSlash($old_id) . $mixte, $this->deleteSlash($request->value) . $mixte, $this->deleteSlash($assujetti->formation) . $mixte));

                break;
            case 'vers_formation':
                event(new TransportEvent($request->value, $assujetti->vers_formation, $assujetti->centre_selection));
                break;
        }
    }

    public function operation($assujetti, $request)
    {
        if ($request->field == "admis" && empty($assujetti->admis) && !empty($request->value)) {
            return 'inc';
        }

        if (is_null($assujetti->{$request->field}) && !empty($request->value)) {
            return 'inc';
        }

        if ($request->field == "admis" && empty($assujetti->admis) && empty($request->value)) {
            return 'nan';
        }

        return 'dec';
    }

    public function deleteSlash($value)
    {
        return str_replace('/', '-', $value);
    }

    public function isMixte($value, $sexe)
    {
        if (in_array($value, ['1°CFA/1°CRFI', '2°CFA/2°CRFI', '7°CFA'])) {
            return '_' . $sexe;
        }

        return '';
    }
}
