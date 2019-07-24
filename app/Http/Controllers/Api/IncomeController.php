<?php

namespace App\Http\Controllers\Api;

use App\Income;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\IncomeRequest;
use Illuminate\Support\Facades\Auth;

class IncomeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        $sort = $request->get('sortBy') ? $request->get('sortBy') : 'id';
        $order = $request->get('descending') ? 'desc' : 'asc';

        return $incomes = Auth::user()->incomes()
            ->where(function ($query) use ($request) {
                $query->where('subject', 'like', '%' . $request->get('search') . '%')
                    ->orWhere('details', 'like', '%' . $request->get('search') . '%');
            })
            ->orderBy($sort, $order)
            ->paginate($request->get('rowsPerPage'));
    }

    public function store(IncomeRequest $request)
    {
        $request->user()->incomes()->create(
            $request->only(['date', 'subject', 'amount', 'details'])
        );

        return ['message' => 'Income successfully recorded!'];
    }

    public function show(Income $income)
    {
        return $income;
    }
}
