<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\IncomeRequest;
use App\Income;

class IncomeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        return view('income.index')
            ->with('incomes', Income::all()->reverse());
    }

    public function create()
    {
        return view('income.create');
    }

    public function store(IncomeRequest $request)
    {
        Income::create(
            $request->only(['date', 'description', 'amount'])
        );

        return redirect()->route('income.index')
            ->with('success', 'Success!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
