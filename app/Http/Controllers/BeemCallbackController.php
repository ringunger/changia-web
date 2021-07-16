<?php

namespace App\Http\Controllers;

use App\Models\Collection;
use App\Models\Contribution;
use http\Env\Response;
use Illuminate\Http\Request;

class BeemCallbackController extends Controller
{

    public function index(Request $request)
    {
        return "Changia.ringlesoft.com";
    }

    public function collection(Request $request){
        $contribution = new Contribution($request->all());
        if($request->has('transaction_id')){
            if($contribution->save()){
                $response_data = ["transaction_id" => $contribution->transaction_id, "successful" => true];
            return response()->json($response_data, 200);
        } else {

            }
        } else {
            return response()->json(['error' => 'Incomplete Data'], 401);
        }
    }

    public function sms_delivery(Request $request)
    {

    }


}
