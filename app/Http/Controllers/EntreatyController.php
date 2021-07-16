<?php

namespace App\Http\Controllers;

use App\Http\Middleware\Authenticate;
use App\Models\Currency;
use App\Models\Entreaty;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EntreatyController extends Controller
{
    public function index(Request $request)
    {
        $data = [
            'entreaties' => Entreaty::all()
        ];
        return view('pages.entreaties.entreaties_list');
    }

    public function create(Request $request)
    {
        if($request->isMethod('post')) {
            if($request->has('createEntreaty')){
                $entreaty = new Entreaty($request->all());
                dump($entreaty);
            }
        }
        $data = [
            'currencies' => Currency::all()
        ];
        return view('pages.entreaties.entreaty_create')->with($data);
    }

    public function view(Request $request, $uid) {
        $entreaty = Entreaty::where('uid', $uid)->first();
        $data = [
            'entreaty' => $entreaty
        ];
        return view('pages.entreaties.entreaty_view')->with($data);
    }


    public function mine(Request $request) {
        $data = [
            'entreaties' => Entreaty::forUser(Auth::user()->id)
        ];
        return view('pages.entreaties.entreaties_list');
    }
}
