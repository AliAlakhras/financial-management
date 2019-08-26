@extends('layout.template')

@section('title','صفحة الشركة')

@section('title_content','إعدادات الشركة')

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
            <a href="index.html"><i class="fa fa-dashboard fa-fw"></i> عمليات البيع</a>
        </li>
        <li>
            <a href="index.html"><i class="fa fa-dashboard fa-fw"></i> عمليات الشراء</a>
        </li>
        <li>
            <a href="{{ route('product.index') }}"><i class="fa fa-dashboard fa-fw"></i> المخزن</a>
        </li>
    </ul>
@endsection

@section('content')
    <div>
        <div style="float: right; width: 50%">
            <ul>
                <li style="margin-bottom: 5px">
                    <a class="btn btn-primary" href="{{ route('user.create') }}" role="button">إضافة موظف</a>
                </li>
                <li style="margin-bottom: 5px">
                    <a href="{{ route('user.createVendorFromCompanyAdmin') }}" class="btn btn-primary" role="button">إضافة مورد</a>
                </li>
                <li style="margin-bottom: 5px">
                    <a href="{{ route('wallet.create') }}" class="btn btn-primary" role="button">إضافة رصيد</a>
                </li>
                <li style="margin-bottom: 5px">
                    <a href="{{ route('product.create') }}" class="btn btn-primary" role="button">إضافة منتج</a>
                </li>
                <li style="margin-bottom: 5px">
                    <a href="{{ route('company.create') }}" class="btn btn-primary" role="button">إضافة عملية شراء</a>
                </li>
                <li style="margin-bottom: 5px">
                    <a href="{{ route('company.create') }}" class="btn btn-primary" role="button">إضافة عملية بيع</a>
                </li>
            </ul>
        </div>

        <div style="float: left; width: 50%">
            <h2> الرصيد المتبقي: {{ $total }} </h2>
        </div>

    </div>
@endsection
