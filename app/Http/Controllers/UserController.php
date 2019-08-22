<?php

namespace App\Http\Controllers;

use App\Company;
use App\CompanyRole;
use App\Role;
use App\User;
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
        return view('company.index');
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
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

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
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function employees()
    {
        $users = User::all();
        $employees = $users->where('role_id', 2);

        return view('company.user', compact('employees'));
    }

    public function vendors()
    {
        $users = User::all();
        $vendors = $users->where('role_id', 3);
        return view('company.user', compact('vendors'));
    }

    public function createUserFromAdminToCompany($id){
        $company = Company::find($id);
        $roles_company = CompanyRole::all();
        return view('admin.create_user', compact( 'roles_company','company'));
    }

    public function storeUserFromAdminToCompany(Request $request, $id){
        $request['company_id'] = $id;
        $request['role_id'] = 2;
        $request['password'] = Hash::make($request['password']);
        User::create($request->all());

        return redirect('company');
    }
}
