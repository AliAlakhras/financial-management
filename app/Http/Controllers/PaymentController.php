<?php

namespace App\Http\Controllers;

use App\Debt;
use App\Payment;
use App\Purchase;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PaymentController extends Controller
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

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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

    public function createPayment($id)
    {
        $purchase = $id;
        return view('payment.create', compact('purchase'));
    }

    public function storePayment(Request $request, $id)
    {
        $request['purchase_id'] = $id;
        $request['company_id'] = Auth::user()->company_id;
        Payment::create($request->all());
        $debt = Debt::where('purchase_id', $id)->first();
        $total = $debt->paid + $debt->due;
        $debt->paid = $debt->paid + $request['paid'];
        $debt->due = $total - $debt->paid;
        $debt->save();
        return redirect('purchase');
    }
}
