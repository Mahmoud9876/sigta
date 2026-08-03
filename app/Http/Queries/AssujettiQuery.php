<?php

namespace App\Http\Queries;

use App\Models\Assujetti;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Facades\DataTables;

Class AssujettiQuery
{
    /**
     * @return JsonResponse
     * @throws \Exception
     */
    public function get()
    {
	
        if(Auth::user()->isSelection()) {
            $assujetti= Assujetti::where('selection', 'like', '%'.Auth::user()->centre.'%' )
		->select('*');
 } else {
            $assujetti = Assujetti::select('*');
        }
        return Datatables::of($assujetti)->make(true);
    }
}
