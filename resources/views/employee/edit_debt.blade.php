@extends('layout.template')

@section('title','صفحة المستخدم')
@section('title_content','الديون')

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
        <form class="form-signin" action="{{ route('debt.update', $dept->id) }}" method="post">
            @csrf
            {{ method_field('put') }}
            <h1 class="h3 mb-3 font-weight-normal">الرجاء إدخال البيانات</h1>
            <input type="number" class="form-control" name="paid" value="{{ $dept->paid }}" placeholder="المبلغ المراد دفعه" required>
            @error('paid')
            <div class="alert alert-danger">{{ $message }}</div>
            @enderror
            <div class="card-footer text-right">
                <button type="submit" class="btn btn-primary">تعديل</button>
            </div>
        </form>
    </div>
@endsection
