@extends('layout.template')

@section('title','صفحة المستخدم')

@section('title_content','إعدادات المستخدم')

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
    <div>
        <div style="float: right; width: 50%">
            <ul>
                <li style="margin-bottom: 5px">
                    <a href="{{ route('expense.create') }}" class="btn btn-primary" role="button">إضافة مصروفات</a>
                </li>
                <li style="margin-bottom: 5px">
                    <a href="{{ route('purchase.create') }}" class="btn btn-primary" role="button">إضافة عملية شراء</a>
                </li>
                <li style="margin-bottom: 5px">
                    <a href="{{ route('sale.create') }}" class="btn btn-primary" role="button">إضافة عملية بيع</a>
                </li>
            </ul>
        </div>

        <div style="float: left; width: 50%">
            <h2> الرصيد المتبقي: {{ $total }} </h2>
        </div>

    </div>
@endsection
