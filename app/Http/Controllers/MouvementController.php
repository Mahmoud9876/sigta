<?php

namespace App\Http\Controllers;

use App\Http\Requests\MouvementRequest;
use App\Models\Centre;
use App\Models\Mouvement;
use App\Models\Selection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MouvementController extends Controller
{
    public function index(Request $request)
    {
        if (Auth::user()->isSelection()) {
            if ($request->date) {
                $mouvements = Mouvement::where('selection', 'like', '%' . Auth::user()->centre . '%')
                    ->where('depart', 'like', '%' . $request->date . '%')->get();
            } else {
                $mouvements = Mouvement::where('selection', 'like', '%' . Auth::user()->centre . '%')->get();
            }
        } else {
            if ($request->date) {
                $mouvements = Mouvement::where('depart', 'like', '%' . $request->date . '%')->orderBy('depart', 'desc')->get();
            } else {
                $mouvements = Mouvement::all();

            }
        }

        $selections = Selection::all();
        $centres = Centre::all();

        return view('mouvements.index', compact('mouvements', 'selections', 'centres'));
    }

    public function store(MouvementRequest $request)
    {
        $input = $request->all();

        if (Auth::user()->isSelection()) {
            $input['selection'] = Auth::user()->centre;
        }

        Mouvement::create($input);

        return redirect()->back()->with('success', 'MOUVEMENT AJOUTÉ AVEC SUCCÈS');
    }

    public function update(MouvementRequest $request, $id)
    {
        $mouvement = Mouvement::find($id);

        if (empty($mouvement)) {
            return redirect()->back()->with('error', 'MOUVEMENT NON TROUVÉ');
        }

        $mouvement->update($request->all());

        return redirect()->back()->with('success', 'MOUVEMENT MODIFIÉ AVEC SUCCÈS');
    }
}
