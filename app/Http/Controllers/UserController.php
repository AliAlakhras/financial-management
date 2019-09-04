<?php

namespace App\Http\Controllers;

use App\Company;
use App\CompanyRole;
use App\Debt;
use App\Expense;
use App\Http\Requests\StoreUserCompanyRequest;
use App\Http\Requests\StoreVendorCompanyRequest;
use App\Http\Requests\UpdateCompanyUserRequest;
use App\Http\Requests\UpdatePasswordRequest;
use App\Http\Requests\UpdateVendorCompanyRequest;
use App\Product;
use App\Purchase;
use App\PurchaseDetailes;
use App\Sale;
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
        $total = $this->total();
        return view('company.index', compact('total'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $roles_company = CompanyRole::all();
        return view('company.create_user', compact('roles_company'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreUserCompanyRequest $request)
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
        $user = User::find($id);
        $users = User::where('company_id', Auth::user()->company_id)->get();
        $role_company = CompanyRole::where('id', $user->company_role_id)->get();
        $expenses = Expense::where('user_id', $id)->get();
        $purchases = Purchase::where('user_id', $id)->with('purchasedetailes')->get();
        $products = Product::where('company_id', Auth::user()->company_id)->get();
        $sales = Sale::where('user_id', $id)->get();
        $purchases_debts = Purchase::where('user_id', $id)->with('debts')->get();
        return view('company.user_details', compact('user', 'users', 'role_company', 'expenses', 'purchases', 'products', 'sales', 'purchases_debts'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $employee = User::find($id);
        $roles_company = CompanyRole::all();
        return view('company.edit_employee', compact('employee', 'roles_company'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateCompanyUserRequest $request, $id)
    {
        $employee = User::find($id);
        $employee->name = $request->input('name');
        $employee->email = $request->input('email');
        $employee->company_role_id = $request->input('company_role_id');
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
        $purchases = Purchase::where('user_id', $id)->get();
        foreach ($purchases as $purchase) {
            $purchasedetailes = PurchaseDetailes::where('purchase_id', $purchase->id)->select('product_id', 'quantity', 'cost')->first();
            $product = Product::where('id', $purchasedetailes->product_id)->select('quantity', 'cost', 'total')->first();
            $sales = Sale::where('product_id', $purchasedetailes->product_id)->get();
            foreach ($sales as $sale){
                $new_product = Product::find($purchasedetailes->product_id);
                $new_product->quantity = $product->quantity - $purchasedetailes->quantity + $sale->quantity;
                $new_product->cost = 0;
                $new_product->total = 0;
                $new_product->save();
            }
        }
        User::find($id)->delete();
        return redirect('user');
    }

    public function employees()
    {
        $users = User::all();
        $employees = $users->where('role_id', 2)->where('company_id', Auth::user()->company_id);
        return view('company.employees', compact('employees'));
    }

    public function vendors()
    {
        $users = User::all();
        $vendors = $users->where('role_id', 3)->where('company_id', Auth::user()->company_id);
        return view('company.vendors', compact('vendors'));
    }

    public function createUserFromAdminToCompany($id)
    {
        $company = Company::find($id);
        $roles_company = CompanyRole::all();
        return view('admin.create_user', compact('roles_company', 'company'));
    }

    public function storeUserFromAdminToCompany(StoreUserCompanyRequest $request, $id)
    {
        $request['company_id'] = $id;
        $request['role_id'] = 2;
        $request['password'] = Hash::make($request['password']);
        User::create($request->all());
        return redirect('company');
    }

    public function createVendorFromCompanyAdmin()
    {
        return view('company.create_vendor');
    }

    public function storeVendorFromCompanyAdmin(StoreVendorCompanyRequest $request)
    {
        $request['company_id'] = Auth::user()->company_id;
        $request['role_id'] = 3;
        $request['password'] = Hash::make($request['password']);
        User::create($request->all());
        return redirect('user');
    }

    public function editVendorFromCompanyAdmin($id)
    {
        $employee = User::find($id);
        return view('company.edit_vendor', compact('employee'));
    }

    public function updateVendorFromCompanyAdmin(UpdateVendorCompanyRequest $request, $id)
    {
        $employee = User::find($id);
        $employee->name = $request->input('name');
        $employee->email = $request->input('email');
        $employee->company_role_id = $request->input('company_role_id');
        $employee->save();
        return redirect('vendors');

    }

    public function editPasswordFromCompanyAdmin($id)
    {
        $employee = User::find($id);
        return view('company.edit_password', compact('employee'));

    }

    public function updatePasswordFromCompanyAdmin(UpdatePasswordRequest $request, $id)
    {
        $employee = User::find($id);
        $employee->password = Hash::make($request['password']);
        $employee->save();
        return redirect('employees');
    }

    public function getEmployees(Request $request)
    {
        if ($request->ajax()) {
            $employees = User::where('role_id', 2)->where('company_id', Auth::user()->company_id);
            return datatables()->of($employees)
                ->addColumn('action', function ($row) {
                    return '<a href="' . route('user.edit', $row->id) . '" class="btn btn-sm btn-primary">Edit</a>';
                })
                ->toJson();
        }
    }

    public function total()
    {
        $wallets = Wallet::where('company_id', Auth::user()->company_id);
        $expenses = Expense::where('company_id', Auth::user()->company_id);
        $purchase = Purchase::where('company_id', Auth::user()->company_id);
        $total = $wallets->sum('income') - $expenses->sum('price') - $purchase->sum('total');
        return $total;
    }

    public function employeePage()
    {
        $total = $this->total();
        return view('employee.index', compact('total'));
    }
}
