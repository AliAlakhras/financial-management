@extends('layout.template')

@section('title','صفحة المستخدم')
@section('title_content','المشتريات')

@section('sidebar')
    <ul class="nav" id="side-menu">
        <li>
            <a href="{{ route('user.employeePage') }}"><i class="fa fa-dashboard fa-fw"></i> صفحة المستخدم</a>
        </li>
        <li>
            <a href="{{ route('expense.getExpensesForEmployee') }}"><i class="fa fa-dashboard fa-fw"></i> المصروفات</a>
        </li>
        <li>
            <a href="{{ route('purchase.getPurchasesForEmployee') }}"><i class="fa fa-dashboard fa-fw"></i> عمليات الشراء</a>
        </li>
        <li>
            <a href="{{ route('sale.getSalesForEmployee') }}"><i class="fa fa-dashboard fa-fw"></i> عمليات البيع</a>
        </li>
        <li>
            <a href="{{ route('product.getProductsForEmployee') }}"><i class="fa fa-dashboard fa-fw"></i> المخزن</a>
        </li>
        <li>
            <a href="{{ route('debt.getDebtsForEmployee') }}"><i class="fa fa-dashboard fa-fw"></i> الديون</a>
        </li>
    </ul>
@endsection

@section('content')
    <div class="col-md-8">
        <form class="form-signin" action="{{ route('purchase.update', $purchase->id) }}" method="post">
            @csrf
            {{ method_field('put') }}
            <h1 class="h3 mb-3 font-weight-normal">الرجاء إدخال البيانات</h1>
            <select class="form-control" name="product_id" required>
                <option value="-1">اختر المنتج</option>
                @foreach($products as $product)
                    @if($purchasedetailes->product_id == $product->id)
                        <option value="{{ $product->id }}" selected>
                            {{ $product->name }}
                        </option>
                    @else
                        <option value="{{ $product->id }}">
                            {{ $product->name }}
                        </option>
                    @endif
                @endforeach
            </select>
            <input type="number" class="form-control" value="{{ $purchasedetailes->quantity }}" name="quantity"
                   placeholder="الكمية" required>
            <input type="number" class="form-control" value="{{ $purchasedetailes->cost }}" name="cost"
                   placeholder="التكلفة" required>
            <select class="form-control" name="vendor_id" required>
                <option value="-1">اختر اسم المورد</option>
                @foreach($vendors as $vendor)
                    @if($purchase->vendor_id == $vendor->id)
                        <option value="{{ $vendor->id }}" selected>
                            {{ $vendor->name }}
                        </option>
                    @else
                        <option value="{{ $vendor->id }}">
                            {{ $vendor->name }}
                        </option>
                    @endif
                @endforeach
            </select>
            <div class="card-footer text-right">
                <button type="submit" class="btn btn-primary">تعديل</button>
            </div>
        </form>
    </div>
@endsection
