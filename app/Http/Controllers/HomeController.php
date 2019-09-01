<?php

namespace App\Http\Controllers;

use App\Expense;
use App\Purchase;
use App\Wallet;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        if (Auth::user()->role_id == 1){
            return redirect('company');
        }elseif (Auth::user()->role_id == 2 && Auth::user()->company_role_id == 1){
            return redirect('user');
        }elseif (Auth::user()->role_id == 2 && Auth::user()->company_role_id == 2){
            return redirect('employeePage');
        }else{
            return redirect('login');
        }
    }

//    public function pageNotFound(){
//        return redirect('home');
//    }

}
