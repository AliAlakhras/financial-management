<?php

namespace App\Http\Controllers;

use App\Company;
use App\CompanyRole;
use App\Expense;
use App\Purchase;
use App\User;
use App\Wallet;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (Auth::user()->role_id == 2 && Auth::user()->company_role_id == 1){
            $total = $this->total();
            return view('company.index', compact('total'));
        }else{
            return redirect('employeePage');
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
            $roles_company = CompanyRole::all();
            return view('company.create_user', compact('roles_company'));
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request['company_id'] = Auth::user()->company_id;
        $request['role_id'] = 2;
        $request['password'] = Hash::make($request['password']);
        User::create($request->all());
        return redirect('user');
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (Auth::user()->role_id == 2 && Auth::user()->company_role_id == 1){
            $employee = User::find($id);
            $roles_company = CompanyRole::all();
            return view('company.edit_employee', compact('employee', 'roles_company'));
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $employee = User::find($id);
        $employee->name= $request->input('name');
        $employee->email= $request->input('email');
        $employee->company_role_id= $request->input('company_role_id');
        $employee->save();
        return redirect('employees');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        User::find($id)->delete();
        return redirect('user');
    }

    public function employees()
    {
        if (Auth::user()->role_id == 2 && Auth::user()->company_role_id == 1){
            $users = User::all();
            $employees = $users->where('role_id',  2)->where('company_id', Auth::user()->company_id);
            return view('company.employees', compact('employees'));
        }
    }

    public function vendors()
    {
        if (Auth::user()->role_id == 2 && Auth::user()->company_role_id == 1){
            $users = User::all();
            $vendors = $users->where('role_id',  3)->where('company_id', Auth::user()->company_id);
            return view('company.vendors', compact('vendors'));
        }
    }

    public function createUserFromAdminToCompany($id)
    {
        if (Auth::user()->role_id == 2 && Auth::user()->company_role_id == 1){
            $company = Company::find($id);
            $roles_company = CompanyRole::all();
            return view('admin.create_user', compact('roles_company', 'company'));
        }
    }

    public function storeUserFromAdminToCompany(Request $request, $id)
    {
        $request['company_id'] = $id;
        $request['role_id'] = 2;
        $request['password'] = Hash::make($request['password']);
        User::create($request->all());
        return redirect('company');
    }

    public function createVendorFromCompanyAdmin()
    {
        if (Auth::user()->role_id == 2 && Auth::user()->company_role_id == 1){
            return view('company.create_vendor');
        }
    }

    public function storeVendorFromCompanyAdmin(Request $request)
    {
        $request['company_id'] = Auth::user()->company_id;
        $request['role_id'] = 3;
        $request['password'] = Hash::make($request['password']);
        User::create($request->all());
        return redirect('user');
    }

    public function editVendorFromCompanyAdmin($id)
    {
        if (Auth::user()->role_id == 2 && Auth::user()->company_role_id == 1){
            $employee = User::find($id);
            return view('company.edit_vendor', compact('employee'));
        }
    }

    public function updateVendorFromCompanyAdmin(Request $request, $id)
    {
        $employee = User::find($id);
        $employee->name= $request->input('name');
        $employee->email= $request->input('email');
        $employee->company_role_id= $request->input('company_role_id');
        $employee->save();
        return redirect('vendors');

    }
    public function editPasswordFromCompanyAdmin($id)
    {
        $employee = User::find($id);
        return view('company.edit_password', compact('employee'));

    }
    public function updatePasswordFromCompanyAdmin(Request $request, $id)
    {
        $employee = User::find($id);
        $request['password'] = Hash::make($request['password']);
        $employee->save();
        return redirect('employees');
    }

    public function getEmployees(Request $request)
    {
        if ($request->ajax()){
            $employees = User::where('role_id',  2)->where('company_id', Auth::user()->company_id);
            return datatables()->of($employees)
                ->addColumn('action',function($row){
                    return '<a href="'.route('user.edit', $row->id).'" class="btn btn-sm btn-primary">Edit</a>';
                })
                ->toJson();
        }
    }

    public function total(){
        $wallets = Wallet::where('company_id', Auth::user()->company_id);
        $expenses = Expense::where('company_id', Auth::user()->company_id);
        $purchase = Purchase::where('company_id', Auth::user()->company_id);
        $total = $wallets->sum('income') - $expenses->sum('price') - $purchase->sum('total');
        return $total;
    }

    public function employeePage(){
        $total = $this->total();
        return view('employee.index',compact('total'));
    }
}
