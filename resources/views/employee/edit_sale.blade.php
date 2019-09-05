@extends('layout.template')

@section('title','صفحة المستخدم')
@section('title_content','المبيعات')

@section('sidebar')
    <ul class="nav" id="side-menu">
        <li>
            <a href="{{ route('user.employeePage') }}"><i class="fa fa-dashboard fa-fw"></i> صفحة المستخدم</a>
        </li>
        <li class="">
            <a href="#"><i class="fa fa-files-o fa-fw"></i> المصروفات<span class="fa arrow"></span></a>
            <ul class="nav nav-second-level">
                <li>
                    <a href="{{ route('expense.getExpensesForEmployee') }}">عرض المصروفات</a>
                </li>
                <li>
                    <a href="{{ route('expense.create') }}">إضافة مصروف</a>
                </li>
            </ul>
        </li>
        <li class="">
            <a href="#"><i class="fa fa-files-o fa-fw"></i>عمليات الشراء<span class="fa arrow"></span></a>
            <ul class="nav nav-second-level">
                <li>
                    <a href="{{ route('purchase.getPurchasesForEmployee') }}">عرض المشتريات</a>
                </li>
                <li>
                    <a href="{{ route('purchase.create') }}">إضافة عملية شراء</a>
                </li>
            </ul>
        </li>
        <li class="">
            <a href="#"><i class="fa fa-files-o fa-fw"></i>عمليات البيع<span class="fa arrow"></span></a>
            <ul class="nav nav-second-level">
                <li>
                    <a href="{{ route('sale.getSalesForEmployee') }}">عرض المبيعات</a>
                </li>
                <li>
                    <a href="{{ route('sale.create') }}">إضافة عملية بيع</a>
                </li>
            </ul>
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
            @error('product_id')
            <div class="alert alert-danger">{{ $message }}</div>
            @enderror
            <input type="number" class="form-control" name="quantity" value="{{ $sale->quantity }}" placeholder="الكمية" required>
            @error('quantity')
            <div class="alert alert-danger">{{ $message }}</div>
            @enderror
            <input type="number" class="form-control" name="cost" value="{{ $sale->cost }}" placeholder="التكلفة" required>
            @error('cost')
            <div class="alert alert-danger">{{ $message }}</div>
            @enderror
            <div class="card-footer text-right">
                <button type="submit" class="btn btn-primary">تعديل</button>
            </div>
        </form>
    </div>
@endsection
