<?php

namespace App\Http\Controllers;

use App\Models\Collection;
use App\Models\Contribution;
use App\Models\Entreaty;
use http\Env\Response;
use Illuminate\Database\Eloquent\Model;
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
                Entreaty::processContribution($contribution->reference_number);
                $response_data = ["transaction_id" => $contribution->transaction_id, "successful" => true];
            return response()->json($response_data, 200);
        } else {

            }
        } else {
            return response()->json(['error' => 'Incomplete Data'], 401);
        }
    }

    public function checkout(Request $request){

        if($request->has('transactionID')){
            $data = [
//                'mcc_network' => null,
//                'mnc_network' => null,
//                'network_name' => null,
                'amount_collected' => $request->input('amount'),
                'transaction_id' => $request->input('transactionID'),
                'subscriber_msisdn' => $request->input('msisdn'),
                'source_currency' => 'TZS',
                'target_currency' => 'TZS',
                'reference_number' => $request->input('referenceNumber'),
                'paybill_number' => '222444',
                'timestamp' => $request->input('timestamp'),
            ];

            $contribution = new Contribution($data);
            print_r($data);
            if($contribution->save()){
                Entreaty::processContribution($data['reference_number']);
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
