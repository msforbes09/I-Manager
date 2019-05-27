<?php

namespace App\Http\Controllers;

use App\Expense;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\ExpenseRequest;

class ExpenseController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $date = Carbon::now()->format('Y-m-d');

        $expenses = Auth::user()->expenses()
            ->select('date', DB::raw('sum(amount) as amount'))
            ->groupBy('date')
            ->orderBy('date', 'desc')
            ->get();

        return view('expense.index', compact('expenses', 'date'));
    }

    public function create($date)
    {
        return view('expense.create', compact('date'));
    }

    public function store(ExpenseRequest $request)
    {
        $request->user()->expenses()->create(
            $request->only(['date', 'subject', 'amount', 'details'])
        );


        return redirect()->route('expense.daily', $request->date)
            ->with('success', 'Success!');
    }

    public function show(Expense $expense)
    {
        return view('expense.show', compact('expense'));
    }

    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        //
    }

    public function daily($date)
    {
        $expenses = Auth::user()->expenses()
            ->where('date', $date)
            ->get();

        return view('expense.daily', compact('date','expenses'));
    }
}
