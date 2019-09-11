@extends('layout.template')

@section('title','صفحة الشركة')

@section('title_content','الدفعات')

@section('sidebar')
    <ul class="nav in" id="side-menu">
        <li>
            <a href="{{ route('user.index') }}"><i class="fa fa-dashboard fa-fw"></i> الشركة</a>
        </li>
        <li class="">
            <a href="#"><i class="fa fa-files-o fa-fw"></i> الموظفين<span class="fa arrow"></span></a>
            <ul class="nav nav-second-level">
                <li>
                    <a href="{{ route('user.employees') }}">عرض الموظفين</a>
                </li>
                <li>
                    <a href="{{ route('user.create') }}">إضافة موظف</a>
                </li>
            </ul>
        </li>
        <li class="">
            <a href="#"><i class="fa fa-files-o fa-fw"></i> الموردين<span class="fa arrow"></span></a>
            <ul class="nav nav-second-level">
                <li>
                    <a href="{{ route('user.vendors') }}">عرض الموردين</a>
                </li>
                <li>
                    <a href="{{ route('user.createVendorFromCompanyAdmin') }}">إضافة مورد</a>
                </li>
            </ul>
        </li>
        <li class="">
            <a href="#"><i class="fa fa-files-o fa-fw"></i> المحفظة<span class="fa arrow"></span></a>
            <ul class="nav nav-second-level">
                <li>
                    <a href="{{ route('wallet.index') }}">عرض </a>
                </li>
                <li>
                    <a href="{{ route('wallet.create') }}">إضافة رصيد</a>
                </li>
            </ul>
        </li>
        <li class="">
            <a href="#"><i class="fa fa-files-o fa-fw"></i> المصروفات<span class="fa arrow"></span></a>
            <ul class="nav nav-second-level">
                <li>
                    <a href="{{ route('expense.index') }}">عرض المصروفات</a>
                </li>
                <li>
                    <a href="{{ route('expense.create') }}">إضافة مصروف</a>
                </li>
            </ul>
        </li>
        <li class="">
            <a href="#"><i class="fa fa-files-o fa-fw"></i>عمليات البيع<span class="fa arrow"></span></a>
            <ul class="nav nav-second-level">
                <li>
                    <a href="{{ route('sale.index') }}">عرض المبيعات</a>
                </li>
                <li>
                    <a href="{{ route('sale.create') }}">إضافة عملية بيع</a>
                </li>
            </ul>
        </li>
        <li class="">
            <a href="#"><i class="fa fa-files-o fa-fw"></i>عمليات الشراء<span class="fa arrow"></span></a>
            <ul class="nav nav-second-level">
                <li>
                    <a href="{{ route('purchase.index') }}">عرض المشتريات</a>
                </li>
                <li>
                    <a href="{{ route('purchase.create') }}">إضافة عملية شراء</a>
                </li>
            </ul>
        </li>
        <li class="">
            <a href="#"><i class="fa fa-files-o fa-fw"></i>المخزن<span class="fa arrow"></span></a>
            <ul class="nav nav-second-level">
                <li>
                    <a href="{{ route('product.index') }}">عرض</a>
                </li>
                <li>
                    <a href="{{ route('product.create') }}">إضافة منتج</a>
                </li>
            </ul>
        </li>
        <li>
            <a href="{{ route('debt.index') }}"><i class="fa fa-dashboard fa-fw"></i> الديون</a>
        </li>
    </ul>
@endsection

@section('content')
    <div class="col-md-8">
    <form class="form-signin" action="{{ route('payment.storePayment', $purchase) }}" method="post">
        @csrf
        <h1 class="h3 mb-3 font-weight-normal">الرجاء إدخال البيانات</h1>
        <input type="text" class="form-control" name="paid" placeholder="المبلغ" required>
        @error('price')
        <div class="alert alert-danger">{{ $message }}</div>
        @enderror

        <div class="card-footer text-right">
            <button type="submit" class="btn btn-primary">إضافة</button>
        </div>
    </form>
    </div>
@endsection
