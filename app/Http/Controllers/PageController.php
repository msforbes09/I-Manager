<?php

namespace App\Http\Controllers;

use Carbon\Carbon;

class PageController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function home()
    {
        return view('pages.home');
    }

    public function summary()
    {
        return view('pages.summary');
    }

    public function income()
    {
        return view('pages.income');
    }

    public function expense()
    {
        return view('pages.expense');
    }
}
