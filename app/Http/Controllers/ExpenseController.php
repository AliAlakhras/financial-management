<?php

namespace App\Http\Controllers;

use App\Expense;
use App\User;
use App\Wallet;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ExpenseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $expenses = Expense::where('company_id', Auth::user()->company_id)->get();
        $users = User::all();
        return view('expense.index', compact('expenses', 'users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('expense.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $wallets = Wallet::where('company_id', Auth::user()->company_id);
        $expenses = Expense::where('company_id', Auth::user()->company_id);
        $total = $wallets->sum('income') - $expenses->sum('price');
        if($request['price'] <= $total){
            $request['user_id'] = Auth::user()->id;
            $request['company_id'] = Auth::user()->company_id;
            Expense::create($request->all());
            return redirect('expense')->with(['success' => 'تم الإضافة بنجاح']);
        }else{
            return redirect('expense')->with(['fail' => 'لا يوجد لديك رصيد كافي']);
        }
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
        $expense = Expense::find($id);
        return view('expense.edit', compact('expense'));
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
        $expense = Expense::find($id);
        $wallets = Wallet::where('company_id', Auth::user()->company_id);
        $expenses = Expense::where('company_id', Auth::user()->company_id);
        $total = $wallets->sum('income') - $expenses->sum('price');
        if ($request['price'] <= $total){
            $expense->user_id = Auth::user()->id;
            $expense->name = $request->input('name');
            $expense->price = $request->input('price');
            $expense->save();
            return redirect('expense')->with(['success' => 'تم التعديل بنجاح']);
        }else{
            return redirect('expense')->with(['fail' => 'لا يوجد لديك رصيد كافي']);
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
        Expense::find($id)->delete();
        return redirect('expense')->with(['success' => 'تم الحذف بنجاح']);
    }
}
