<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
        $user = Auth::user();

        $user->income = number_format($user->incomes()
                    ->where('date', Carbon::today())
                    ->sum('amount'), 2);

        $user->expense = number_format($user->expenses()
                    ->where('date', Carbon::today())
                    ->sum('amount'), 2);

        $user->onhand = number_format($user->incomes()->sum('amount') - $user->expenses()->sum('amount'), 2);

        return view('pages.summary', compact('user'));
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
