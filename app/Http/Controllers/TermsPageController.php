<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TermsPageController extends Controller
{
    public function index()
    {
        $data = [];
        return view('pages.terms.terms')->with($data);
    }
    public function about()
    {
        $data = [];
        return view('pages.terms.about')->with($data);
    }
}
