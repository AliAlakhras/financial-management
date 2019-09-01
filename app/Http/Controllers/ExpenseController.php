<?php

namespace App\Http\Controllers;

use App\Expense;
use App\Http\Requests\ExpenseRequest;
use App\Purchase;
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
        if (Auth::user()->role_id == 2 && Auth::user()->company_role_id == 1){
            $expenses = Expense::where('company_id', Auth::user()->company_id)->get();
            $users = User::where('company_id', Auth::user()->company_id)->get();
            $total_expenses = $expenses->sum('price');
            return view('expense.index', compact('expenses', 'users', 'total_expenses'));
        }else{
            return redirect('getExpensesForEmployee');
        }

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (Auth::user()->role_id == 2 && Auth::user()->company_role_id == 1){
            return view('expense.create');
        }else{
            return view('employee.create_expense');
        }

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ExpenseRequest $request)
    {
        if($request['price'] <= $this->total()){
            $request['user_id'] = Auth::user()->id;
            $request['company_id'] = Auth::user()->company_id;
            Expense::create($request->all());
            if (Auth::user()->role_id == 2 && Auth::user()->company_role_id == 2){
                return redirect('getExpensesForEmployee')->with(['success' => 'تم الإضافة بنجاح']);
            }else{
                return redirect('expense')->with(['success' => 'تم الإضافة بنجاح']);
            }
        }else{
            if (Auth::user()->role_id == 2 && Auth::user()->company_role_id == 2){
                return redirect('getExpensesForEmployee')->with(['fail' => 'لا يوجد لديك رصيد كافي']);
            }else{
                return redirect('expense')->with(['fail' => 'لا يوجد لديك رصيد كافي']);
            }
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
        if (Auth::user()->role_id == 2 && Auth::user()->company_role_id == 1){
            $expense = Expense::find($id);
            return view('expense.edit', compact('expense'));
        }else{
            $expense = Expense::find($id);
            return view('employee.edit_expense', compact('expense'));
        }

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ExpenseRequest $request, $id)
    {
        $expense = Expense::find($id);
        if ($request['price'] <= $this->total()){
            $expense->user_id = Auth::user()->id;
            $expense->name = $request->input('name');
            $expense->price = $request->input('price');
            $expense->save();
            if (Auth::user()->role_id == 2 && Auth::user()->company_role_id == 2){
                return redirect('getExpensesForEmployee')->with(['success' => 'تم التعديل بنجاح']);
            }else{
                return redirect('expense')->with(['success' => 'تم التعديل بنجاح']);
            }
        }else{
            if (Auth::user()->role_id == 2 && Auth::user()->company_role_id == 2){
                return redirect('getExpensesForEmployee')->with(['fail' => 'لا يوجد لديك رصيد كافي']);
            }else{
                return redirect('expense')->with(['fail' => 'لا يوجد لديك رصيد كافي']);
            }
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
        if (Auth::user()->role_id == 2 && Auth::user()->company_role_id == 2){
            return redirect('getExpensesForEmployee')->with(['success' => 'تم الحذف بنجاح']);
        }else{
            return redirect('expense')->with(['success' => 'تم الحذف بنجاح']);
        }
    }

    public function total(){
        $wallets = Wallet::where('company_id', Auth::user()->company_id);
        $expenses = Expense::where('company_id', Auth::user()->company_id);
        $purchase = Purchase::where('company_id', Auth::user()->company_id);
        $total = $wallets->sum('income') - $expenses->sum('price') - $purchase->sum('total');
        return $total;
    }

    public function getExpensesForEmployee(){
        $expenses = Expense::where('user_id', Auth::user()->id)->get();
        $total_expenses = $expenses->sum('price');
        return view('employee.get_expenses', compact('expenses', 'total_expenses'));
    }

}
