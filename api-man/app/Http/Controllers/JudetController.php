<?php

namespace App\Http\Controllers;

use App\Judet;
use App\Localitate;

use Illuminate\Http\Request;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\DB;

class JudetController extends Controller
{
    /**
     * Get judet name by localitate.
     *
     * @param object $request - data sent by js | by http request
     * @return array JSON
     */
    public function getJudetByLocalitate(Request $request)
    {
        $result = array();
        $localitateModelInit = Localitate::where('nume', $request->input('loc_nume'))->first();

        try {
            if($localitateModelInit) {
                $result['message'] = 'success';
                $result['judet_id'] = $localitateModelInit->judet_id;
                $result['judet_nume'] = Judet::find($localitateModelInit['judet_id'])->nume;
            } else {
                $result['message'] = 'fail';
                $result['description'] = 'Nu exista localitatea in baza de date.';
            }
        } catch (QueryException $exception) {
            $result['message'] = 'fail';
            $result['description'] = 'DB Exception #' . $exception->errorInfo[1] . '[' .$exception->errorInfo[2] . ']';
        }

        return response()->json($result);
    }
}
