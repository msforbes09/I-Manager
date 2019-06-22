<?php

namespace App\Http\Controllers\Api;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ExpenseController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        $sort = $request->get('sortBy') ? $request->get('sortBy') : 'date';

        return Auth::user()->expenses()
            ->select('date', DB::raw('sum(amount) as amount'))
            ->groupBy('date')
            ->orderBy($sort, $request->get('descending') ? 'desc' : 'asc')
            ->paginate($request->get('rowsPerPage'));
    }
}
