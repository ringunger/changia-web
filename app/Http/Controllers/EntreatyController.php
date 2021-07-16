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
        $notifications = [];
        if($request->isMethod('post')) {
            if($request->has('createEntreaty')){
                $entreaty = new Entreaty($request->all());
                if($entreaty->save()){
                    $notification = ['type' => 'success', 'title' => 'Entreaty Created', 'text' => 'Your entreaty was created successfully'];
                } else {
                    $notification = ['type' => 'danger', 'title' => 'Failed!', 'text' => 'Could not create entreaty. Please try again'];
                    // TODO mirror the input values back
                }
                $notification[] = $notification;
                $data = [
                    'currencies' => Currency::all(),
                    'notifications' => $notifications
                ];
                return redirect()->back()->with($data);
            }
        }
        $data = [
            'currencies' => Currency::all(),
            'notifications' => $notifications
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
