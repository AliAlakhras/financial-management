@extends('layout.template')

@section('title','صفحة الشركة')
@section('title_content','المشتريات')

@section('sidebar')
    <ul class="nav" id="side-menu">
        <li>
            <a href="{{ route('user.index') }}"><i class="fa fa-dashboard fa-fw"></i> الشركة</a>
        </li>
        <li>
            <a href="{{ route('user.employees') }}"><i class="fa fa-dashboard fa-fw"></i> الموظفين</a>
        </li>
        <li>
            <a href="{{ route('user.vendors') }}"><i class="fa fa-dashboard fa-fw"></i> الموردين</a>
        </li>
        <li>
            <a href="{{ route('wallet.index') }}"><i class="fa fa-dashboard fa-fw"></i> المحفظة</a>
        </li>
        <li>
            <a href="{{ route('expense.index') }}"><i class="fa fa-dashboard fa-fw"></i> المصروفات</a>
        </li>
        <li>
            <a href="{{ route('sale.index') }}"><i class="fa fa-dashboard fa-fw"></i> عمليات البيع</a>
        </li>
        <li>
            <a href="{{ route('purchase.index') }}"><i class="fa fa-dashboard fa-fw"></i> عمليات الشراء</a>
        </li>
        <li>
            <a href="{{ route('product.index') }}"><i class="fa fa-dashboard fa-fw"></i> المخزن</a>
        </li>
    </ul>
@endsection

@section('content')
    <div class="col-md-8">
        <form class="form-signin" action="{{ route('sale.update', $sale->id) }}" method="post">
            @csrf
            {{ method_field('put') }}
            <h1 class="h3 mb-3 font-weight-normal">الرجاء إدخال البيانات</h1>
            <select class="form-control" name="product_id" required>
                <option value="-1">اختر المنتج</option>
                @foreach($products as $product)
                    @if($sale->product_id == $product->id)
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
            <input type="number" class="form-control" name="quantity" value="{{ $sale->quantity }}" placeholder="الكمية" required>
            <input type="number" class="form-control" name="cost" value="{{ $sale->cost }}" placeholder="التكلفة" required>
            <div class="card-footer text-right">
                <button type="submit" class="btn btn-primary">تعديل</button>
            </div>
        </form>
    </div>
@endsection