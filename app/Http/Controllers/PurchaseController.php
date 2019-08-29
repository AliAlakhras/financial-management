<?php

namespace App\Http\Controllers;

use App\Expense;
use App\Product;
use App\Purchase;
use App\PurchaseDetailes;
use App\User;
use App\Wallet;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PurchaseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $purchases = Purchase::where('company_id', Auth::user()->company_id)->with('purchasedetailes')->get();
        $users = User::where('company_id', Auth::user()->company_id)->get();
        $products = Product::where('company_id', Auth::user()->company_id)->get();
        $total_purchases = $purchases->sum('total');
        return view('purchase.index', compact('purchases', 'users', 'total_purchases', 'products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $products = Product::where('company_id', Auth::user()->company_id)->get();
        $vendors = User::where('role_id',  3)->where('company_id', Auth::user()->company_id)->get();
        return view('purchase.create', compact('products', 'vendors'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if (($request['quantity'] * $request['cost']) <= $this->total()){
            $request['user_id'] = Auth::user()->id;
            $request['company_id'] = Auth::user()->company_id;
            $request['total'] = $request['quantity'] * $request['cost'];
            $purchase = Purchase::create($request->all());
            $request['purchase_id'] = $purchase->id;
            PurchaseDetailes::create($request->all());
            $addToProduct = Product::find($request['product_id']);
            $addToProduct->quantity = $request->input('quantity') + $addToProduct->quantity;
            $addToProduct->cost = $request->input('cost');
            $addToProduct->total = $addToProduct->quantity *  $addToProduct->cost;
            $addToProduct->save();
            return redirect('purchase')->with(['success' => 'تم الإضافة بنجاح']);
        }else{
            return redirect('purchase')->with(['fail' => 'لا يوجد لديك رصيد كافي']);
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
        $purchase = Purchase::find($id);
        $purchasedetailes = PurchaseDetailes::where('purchase_id', $id)->first();
        $products = Product::where('company_id', Auth::user()->company_id)->get();
        $vendors = User::where('role_id',  3)->where('company_id', Auth::user()->company_id)->get();
        return view('purchase.edit', compact('purchase', 'purchasedetailes', 'products', 'vendors'));
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
        $purchasedetailes = PurchaseDetailes::where('purchase_id', $id)->select('product_id', 'quantity', 'cost')->first();
        $product = Product::where('id', $purchasedetailes->product_id)->select('quantity', 'cost', 'total')->first();
        $new_product = Product::find($purchasedetailes->product_id);
        $new_product->quantity = $product->quantity - $purchasedetailes->quantity;
        $new_product->total = $product->total - ($purchasedetailes->quantity * $purchasedetailes->cost);
        if ($new_product->quantity == 0)
        {
            $new_product->cost = 0;
        }
        $new_product->save();
        PurchaseDetailes::where('purchase_id', $id)->delete();
        Purchase::find($id)->delete();

        return redirect('purchase')->with(['success' => 'تم الحذف بنجاح']);
    }

    public function total(){
        $wallets = Wallet::where('company_id', Auth::user()->company_id);
        $expenses = Expense::where('company_id', Auth::user()->company_id);
        $purchase = Purchase::where('company_id', Auth::user()->company_id);
        $total = $wallets->sum('income') - $expenses->sum('price') - $purchase->sum('total');
        return $total;
    }


}
