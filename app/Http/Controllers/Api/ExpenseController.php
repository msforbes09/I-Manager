<?php

namespace App\Http\Controllers\Api;

use App\Expense;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\ExpenseRequest;

class ExpenseController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        $sort = $request->get('sortBy') ? $request->get('sortBy') : 'date';
        $order = $request->get('descending') ? 'desc' : 'asc';

        return Auth::user()->expenses()
            ->select('date', DB::raw('sum(amount) as amount'))
            ->groupBy('date')
            ->orderBy($sort, $order)
            ->paginate($request->get('rowsPerPage'));
    }

    public function store(ExpenseRequest $request)
    {
        $request->user()->expenses()->create(
            $request->only(['date', 'subject', 'amount', 'details'])
        );

        return ['message' => 'Success!'];
    }

    public function daily($date)
    {
        return Auth::user()->expenses()
            ->where('date', $date)
            ->get();
    }

    public function show(Expense $expense)
    {
        return $expense;
    }

    public function search(Request $request)
    {
        $sort = $request->get('sortBy') ? $request->get('sortBy') : 'id';
        $order = $request->get('descending') ? 'desc' : 'asc';

        return Auth::user()->expenses()
            ->where(function ($query) use ($request) {
                $query->where('subject', 'like', '%' . $request->get('search') . '%')
                    ->orWhere('details', 'like', '%' . $request->get('search') . '%');
            })
            ->orderBy($sort, $order)
            ->paginate(10);
    }
}
