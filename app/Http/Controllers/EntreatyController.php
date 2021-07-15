<?php

namespace App\Http\Controllers;

use App\Models\Currency;
use App\Models\Entreaty;
use Illuminate\Http\Request;

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
}
