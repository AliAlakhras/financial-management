<?php

namespace App\Http\Controllers;

use App\Product;
use App\PurchaseDetailes;
use App\Sale;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SaleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (Auth::user()->role_id == 2 && Auth::user()->company_role_id == 1){
            $sales = Sale::where('company_id', Auth::user()->company_id)->get();
            $users = User::where('company_id', Auth::user()->company_id)->get();
            $products = Product::where('company_id', Auth::user()->company_id)->get();
            $total_sales = $sales->sum('total');
            return view('sale.index', compact('sales', 'users', 'products', 'total_sales'));
        }else{
            return redirect('getSalesForEmployee');
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
            $products = Product::where('company_id', Auth::user()->company_id)->get();
            return view('sale.create', compact('products'));
        }else{
            $products = Product::where('company_id', Auth::user()->company_id)->get();
            return view('employee.create_sale', compact('products'));
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
        $product = Product::find($request['product_id']);
        if ($request['quantity'] <= $product->quantity) {
            $request['user_id'] = Auth::user()->id;
            $request['company_id'] = Auth::user()->company_id;
            $request['total'] = $request['quantity'] * $request['cost'];
            Sale::create($request->all());

            $product->quantity = $product->quantity - $request['quantity'];
            if ($product->quantity == 0) {
                $product->cost = 0;
            }
            $product->total = $product->quantity * $product->cost;
            $product->save();
            if (Auth::user()->role_id == 2 && Auth::user()->company_role_id == 2){
                return redirect('getSalesForEmployee')->with(['success' => 'تم الحذف بنجاح']);
            }else{
                return redirect('sale')->with(['success' => 'تم الإضافة بنجاح']);
            }
        } else {
            if (Auth::user()->role_id == 2 && Auth::user()->company_role_id == 2){
                return redirect('getSalesForEmployee')->with(['fail' => 'لا يوجد لديك كمية كافية']);
            }else{
                return redirect('sale')->with(['fail' => 'لا يوجد لديك كمية كافية']);
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
        if (Auth::user()->role_id == 2 && Auth::user()->company_role_id == 1){
            $sale = Sale::find($id);
            $products = Product::where('company_id', Auth::user()->company_id)->get();
            return view('sale.edit', compact('sale', 'products'));
        }else{
            $sale = Sale::find($id);
            $products = Product::where('company_id', Auth::user()->company_id)->get();
            return view('employee.edit_sale', compact('sale', 'products'));
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
        $product = Product::find($request->input('product_id'));
        if ($request['quantity'] <= $product->quantity) {
            $sale = Sale::find($id);
            $oldProductId = $sale->product_id;
            $sale->product_id = $request->input('product_id');
            $sale->quantity = $request->input('quantity');
            $sale->cost = $request->input('cost');
            $sale->total = $sale->quantity * $sale->cost;
            $sale->save();

            $quantityPurchaseDetailes = PurchaseDetailes::where('product_id', $sale->product_id)->get('quantity');
            $quantityProductSale = Sale::where('product_id', $sale->product_id)->get('quantity');
            $product->quantity = $quantityPurchaseDetailes->sum('quantity') - $quantityProductSale->sum('quantity');
            $product->cost = $request->input('cost');
            $product->total = $product->cost * $product->quantity;
            if ($product->quantity == 0) {
                $product->cost = 0;
            }
            $product->save();
            if ($oldProductId != $request->input('product_id')) {
                $oldProduct = Product::find($oldProductId);
                $quantityPurchaseDetailes = PurchaseDetailes::where('product_id', $oldProductId)->get('quantity');
                $quantityProductSale = Sale::where('product_id', $oldProductId)->get('quantity');
                $oldProduct->quantity = $quantityPurchaseDetailes->sum('quantity') - $quantityProductSale->sum('quantity');
                $oldProduct->cost = $request->input('cost');
                $oldProduct->total = $oldProduct->quantity * $oldProduct->cost;
                if ($oldProduct->quantity == 0) {
                    $oldProduct->cost = 0;
                }
                $oldProduct->save();
            }
            if (Auth::user()->role_id == 2 && Auth::user()->company_role_id == 2){
                return redirect('getSalesForEmployee')->with(['success' => 'تم التعديل بنجاح']);
            }else{
                return redirect('sale')->with(['success' => 'تم التعديل بنجاح']);
            }
        } else {
            if (Auth::user()->role_id == 2 && Auth::user()->company_role_id == 2){
                return redirect('getSalesForEmployee')->with(['fail' => 'لا يوجد لديك كمية كافية']);
            }else{
                return redirect('sale')->with(['fail' => 'لا يوجد لديك كمية كافية']);
            }
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $sale = Sale::find($id);
        $product = Product::find($sale->product_id);
        $product->quantity = $product->quantity + $sale->quantity;
        $product->total = $product->quantity * $product->cost;
        $product->save();
        $sale->delete();
        if (Auth::user()->role_id == 2 && Auth::user()->company_role_id == 2){
            return redirect('getSalesForEmployee')->with(['success' => 'تم الحذف بنجاح']);
        }else{
            return redirect('sale')->with(['success' => 'تم الحذف بنجاح']);
        }
    }

    public function getSalesForEmployee()
    {
        $sales = Sale::where('user_id', Auth::user()->id)->get();
        $products = Product::where('company_id', Auth::user()->company_id)->get();
        $total_sales = $sales->sum('total');
        return view('employee.get_sales', compact('sales', 'products', 'total_sales'));
    }
}
