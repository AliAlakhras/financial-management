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
        <li>
            <a href="{{ route('debt.index') }}"><i class="fa fa-dashboard fa-fw"></i> الديون</a>
        </li>
    </ul>
@endsection

@section('content')
    <div class="col-md-8">
    <form class="form-signin" action="{{ route('purchase.store') }}" method="post">
        @csrf
        <h1 class="h3 mb-3 font-weight-normal">الرجاء إدخال البيانات</h1>
        <select class="form-control" name="product_id" required>
            <option value="-1">اختر المنتج</option>
            @foreach($products as $product)
                <option value="{{ $product->id }}">
                    {{ $product->name }}
                </option>
            @endforeach
        </select>
        <input type="number" class="form-control" name="quantity" placeholder="الكمية" required>
        <input type="number" class="form-control" name="cost" placeholder="التكلفة" required>
        <select class="form-control" name="vendor_id" required>
            <option value="-1">اختر اسم المورد</option>
            @foreach($vendors as $vendor)
                <option value="{{ $vendor->id }}">
                    {{ $vendor->name }}
                </option>
            @endforeach
        </select>
        <input type="number" class="form-control" name="paid" placeholder="المبلغ المراد دفعه للمورد" required>
        <div class="card-footer text-right">
            <button type="submit" class="btn btn-primary">إضافة</button>
        </div>
    </form>
    </div>
@endsection
