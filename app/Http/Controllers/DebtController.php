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
        if (Auth::user()->role_id == 2 && Auth::user()->company_role_id == 1){
            $purchases = Purchase::where('company_id', Auth::user()->company_id)->with('debts')->get();
            $users = User::where('company_id', Auth::user()->company_id)->get();
            return view('debt.index', compact('purchases', 'users'));
        }else{
            return redirect('getDebtsForEmployee');
        }

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
        if (Auth::user()->role_id == 2 && Auth::user()->company_role_id == 1){
            $dept = Debt::find($id);
            return view('debt.edit', compact('dept'));
        }else{
            $dept = Debt::find($id);
            return view('employee.edit_debt', compact('dept'));
        }

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
        if (Auth::user()->role_id == 2 && Auth::user()->company_role_id == 1){
            return redirect('debt')->with(['success' => 'تم التعديل بنجاح']);
        }else{
            return redirect('getDebtsForEmployee')->with(['success' => 'تم الإضافة بنجاح']);
        }

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
        if (Auth::user()->role_id == 2 && Auth::user()->company_role_id == 1){
            return redirect('debt')->with(['success' => 'تم الحذف بنجاح']);
        }else{
            return redirect('getDebtsForEmployee')->with(['success' => 'تم الحذف بنجاح']);
        }
    }

    public function getDebtsForEmployee()
    {
        $purchases = Purchase::where('user_id', Auth::user()->id)->with('debts')->get();
        $users = User::where('company_id', Auth::user()->company_id)->get();
        return view('employee.get_debts', compact('purchases', 'users'));
    }
}
