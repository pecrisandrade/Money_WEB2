<?php

namespace App\Http\Controllers;

use App\Models\Money;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class MoneyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Money::create([
            'describe' => $request->describe,
            'value' => $request->value,
            'date' => $request->date,
            'user_id' => Auth::user()->id,
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Money  $money
     * @return \Illuminate\Http\Response
     */
    public function show(Money $money)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Money  $money
     * @return \Illuminate\Http\Response
     */
    public function edit(Money $money)
    {
        return Inertia::render('EditFormMoney', [
            'money' => $money
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Money  $money
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Money $money)
    {
        $money->describe= $request->describe;
        $money->value= $request->value;
        $money->date= $request->date;
        $money->save();

        return redirect('/dashboard');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Money  $Money
     * @return \Illuminate\Http\Response
     */
    public function destroy(Money $Money)
    {
        $Money->delete();
    }
}