<?php

namespace App\Http\Controllers;

use App\Debt;
use App\Purchase;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DebtController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $purchases = Purchase::where('company_id', Auth::user()->company_id)->with('debts')->get();
        $users = User::where('company_id', Auth::user()->company_id)->get();
        return view('debt.index', compact('purchases', 'users'));
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
        $dept = Debt::find($id);
        return view('debt.edit', compact('dept'));
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
        $debt = Debt::find($id);
        $total = $debt->paid + $debt->due ;
        $debt->paid = $request->input('paid');
        $debt->due = $total - $debt->paid;
        $debt->save();
        return redirect('debt')->with(['success' => 'تم التعديل بنجاح']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Debt::find($id)->delete();
        return redirect('debt');
    }

    public function getDebtsForEmployee()
    {
        $purchases = Purchase::where('user_id', Auth::user()->id)->with('debts')->get();
        $users = User::where('company_id', Auth::user()->company_id)->get();
        return view('employee.get_debts', compact('purchases', 'users'));
    }
}
