<?php

namespace App\Http\Controllers;

use App\Debt;
use App\Expense;
use App\Http\Requests\StorePurchaseRequest;
use App\Http\Requests\UpdatePurchaseRequest;
use App\Product;
use App\Purchase;
use App\PurchaseDetailes;
use App\Sale;
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
        if (Auth::user()->role_id == 2 && Auth::user()->company_role_id == 1) {
            $purchases = Purchase::where('company_id', Auth::user()->company_id)->with('purchasedetailes')->get();
            $users = User::where('company_id', Auth::user()->company_id)->get();
            $products = Product::where('company_id', Auth::user()->company_id)->get();
            $total_purchases = $purchases->sum('total');
            return view('purchase.index', compact('purchases', 'users', 'total_purchases', 'products'));
        } else {
            return redirect('getPurchasesForEmployee');
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (Auth::user()->role_id == 2 && Auth::user()->company_role_id == 1) {
            $products = Product::where('company_id', Auth::user()->company_id)->get();
            $vendors = User::where('role_id', 3)->where('company_id', Auth::user()->company_id)->get();
            return view('purchase.create', compact('products', 'vendors'));
        } else {
            $products = Product::where('company_id', Auth::user()->company_id)->get();
            $vendors = User::where('role_id', 3)->where('company_id', Auth::user()->company_id)->get();
            return view('employee.create_purchase', compact('products', 'vendors'));
        }

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePurchaseRequest $request)
    {
        if (($request['quantity'] * $request['cost']) <= $this->total()) {
            $request['user_id'] = Auth::user()->id;
            $request['company_id'] = Auth::user()->company_id;
            $request['total'] = $request['quantity'] * $request['cost'];
            $purchase = Purchase::create($request->all());
            $request['purchase_id'] = $purchase->id;
            PurchaseDetailes::create($request->all());
            if ($request['paid'] != $request['total']) {
                $request['due'] = $request['total'] - $request['paid'];
                Debt::create($request->all());
            }
            $addToProduct = Product::find($request['product_id']);
            $addToProduct->quantity = $request->input('quantity') + $addToProduct->quantity;
            $addToProduct->cost = $request->input('cost');
            $addToProduct->total = $addToProduct->quantity * $addToProduct->cost;
            $addToProduct->save();
            if (Auth::user()->role_id == 2 && Auth::user()->company_role_id == 2) {
                return redirect('getPurchasesForEmployee')->with(['success' => 'تم الإضافة بنجاح']);
            } else {
                return redirect('purchase')->with(['success' => 'تم الإضافة بنجاح']);
            }
        } else {
            if (Auth::user()->role_id == 2 && Auth::user()->company_role_id == 2) {
                return redirect('getPurchasesForEmployee')->with(['fail' => 'لا يوجد لديك رصيد كافي']);
            } else {
                return redirect('purchase')->with(['fail' => 'لا يوجد لديك رصيد كافي']);
            }
        }
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
        $purchase = Purchase::find($id);
        $purchasedetailes = PurchaseDetailes::where('purchase_id', $id)->first();
        $products = Product::where('company_id', Auth::user()->company_id)->get();
        $vendors = User::where('role_id', 3)->where('company_id', Auth::user()->company_id)->get();
        if (Auth::user()->role_id == 2 && Auth::user()->company_role_id == 1) {
            return view('purchase.edit', compact('purchase', 'purchasedetailes', 'products', 'vendors'));
        } else {
            return view('employee.edit_purchase', compact('purchase', 'purchasedetailes', 'products', 'vendors'));
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePurchaseRequest $request, $id)
    {
        $purchasedetailes = PurchaseDetailes::where('purchase_id', $id)->select('id', 'product_id', 'quantity', 'cost')->first();
        $purchase = Purchase::find($id);
        if (($request->input('quantity') <= $purchasedetailes->quantity)
            || (($request->input('quantity') > $purchasedetailes->quantity)
                && ($this->total() >= (($request->input('quantity') - $purchasedetailes->quantity) * $request->input('cost'))))) {
            $purchase->total = $request->input('quantity') * $request->input('cost');
            $purchase->user_id = Auth::user()->id;
            $purchase->vendor_id = $request->input('vendor_id');
            $purchase->save();

            $purchasedetailesDone = PurchaseDetailes::find($purchasedetailes->id);
            $purchasedetailesDone->product_id = $request->input('product_id');
            $purchasedetailesDone->quantity = $request->input('quantity');
            $purchasedetailesDone->cost = $request->input('cost');
            $purchasedetailesDone->save();

            if ($request->input('product_id') == $purchasedetailes->product_id) {
                $this->updatePurchaseProductEqualProduct($purchasedetailesDone);
            } else {
                $this->updatePurchaseProductNotEqualProduct($purchasedetailesDone, $purchasedetailes);
            }
            if (Auth::user()->role_id == 2 && Auth::user()->company_role_id == 2) {
                return redirect('getPurchasesForEmployee')->with(['success' => 'تم التعديل بنجاح']);
            } else {
                return redirect('purchase')->with(['success' => 'تم التعديل بنجاح']);
            }
        } elseif (($request->input('quantity') > $purchasedetailes->quantity) && $purchase->total > $this->total()) {
            if (Auth::user()->role_id == 2 && Auth::user()->company_role_id == 2) {
                return redirect('getPurchasesForEmployee')->with(['fail' => 'لا يوجد لديك رصيد كافي']);
            } else {
                return redirect('purchase')->with(['fail' => 'لا يوجد لديك رصيد كافي']);
            }
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public
    function destroy($id)
    {
        $purchasedetailes = PurchaseDetailes::where('purchase_id', $id)->select('product_id', 'quantity', 'cost')->first();
        $product = Product::where('id', $purchasedetailes->product_id)->select('quantity', 'cost', 'total')->first();
        $new_product = Product::find($purchasedetailes->product_id);
        $new_product->quantity = $product->quantity - $purchasedetailes->quantity;
        $new_product->total = $product->total - ($purchasedetailes->quantity * $purchasedetailes->cost);
        if ($new_product->quantity == 0) {
            $new_product->cost = 0;
        }
        $sale = Sale::where('product_id', $purchasedetailes->product_id)->get();
        if (($sale->sum('quantity') > $new_product->quantity) || $new_product->quantity == 0) {
            $new_product->quantity = $product->quantity - $purchasedetailes->quantity + $sale->sum('quantity');
            Sale::where('product_id', $purchasedetailes->product_id)->delete();
        }
        $new_product->save();
        Purchase::find($id)->delete();
        if (Auth::user()->role_id == 2 && Auth::user()->company_role_id == 2) {
            return redirect('getPurchasesForEmployee')->with(['success' => 'تم الحذف بنجاح']);
        } else {
            return redirect('purchase')->with(['success' => 'تم الحذف بنجاح']);
        }
    }

    public
    function total()
    {
        $wallets = Wallet::where('company_id', Auth::user()->company_id);
        $expenses = Expense::where('company_id', Auth::user()->company_id);
        $purchase = Purchase::where('company_id', Auth::user()->company_id);
//        $debts = Debt::where('company_id', Auth::user()->company_id)->where('due', '<>', 0)->get();
//        $sum_paid = $debts->sum('paid');
//        if (count($debts)>0){
//            $total = $wallets->sum('income') - $expenses->sum('price') - $sum_paid;
//        }
        $total = $wallets->sum('income') - $expenses->sum('price') - $purchase->sum('total');
        return $total;
    }

    public
    function getPurchasesForEmployee()
    {
        $purchases = Purchase::where('user_id', Auth::user()->id)->with('purchasedetailes')->get();
        $users = User::where('company_id', Auth::user()->company_id)->get();
        $products = Product::where('company_id', Auth::user()->company_id)->get();
        $total_purchases = $purchases->sum('total');
        return view('employee.get_purchases', compact('purchases', 'users', 'total_purchases', 'products'));
    }

    function updatePurchaseProductEqualProduct($purchasedetailesDone){
        $product = Product::find($purchasedetailesDone->product_id);
        $quantity = PurchaseDetailes::where('product_id', $purchasedetailesDone->product_id)->get('quantity');
        $product->quantity = $quantity->sum('quantity');
        $product->cost = $purchasedetailesDone->cost;
        $product->total = $purchasedetailesDone->quantity * $purchasedetailesDone->cost;
        if ($product->quantity == 0) {
            $product->cost = 0;
        }
        $product->save();
    }

    function updatePurchaseProductNotEqualProduct($purchasedetailesDone, $purchasedetailes){
        $new_product = Product::find($purchasedetailesDone->product_id);
        $quantity = PurchaseDetailes::where('product_id', $purchasedetailesDone->product_id)->get('quantity');
        $new_product->quantity = $quantity->sum('quantity');
        $new_product->cost = $purchasedetailesDone->cost;
        $new_product->total = $purchasedetailesDone->quantity * $purchasedetailesDone->cost;
        $old_product = Product::find($purchasedetailes->product_id);
        $oldquantity = PurchaseDetailes::where('product_id', $purchasedetailes->product_id)->get('quantity');
        $old_product->quantity = $oldquantity->sum('quantity');
        $old_product->cost = $purchasedetailesDone->cost;
        $old_product->total = $old_product->quantity * $old_product->cost;
        if ($new_product->quantity == 0 && $old_product->quantity == 0) {
            $new_product->cost = 0;
            $old_product->cost = 0;
        }
        $new_product->save();
        $old_product->save();
    }

}
