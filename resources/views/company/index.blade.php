@extends('layout.template')

@section('title','صفحة الشركة')

@section('title_content','إعدادات الشركة')

@section('sidebar')
    <ul class="nav" id="side-menu">
        <li>
            <a href="index.html"><i class="fa fa-dashboard fa-fw"></i> الموظفين</a>
        </li>
        <li>
            <a href="index.html"><i class="fa fa-dashboard fa-fw"></i> الموردين</a>
        </li>
        <li>
            <a href="index.html"><i class="fa fa-dashboard fa-fw"></i> عمليات البيع</a>
        </li>
        <li>
            <a href="index.html"><i class="fa fa-dashboard fa-fw"></i> عمليات الشراء</a>
        </li>
        <li>
            <a href="index.html"><i class="fa fa-dashboard fa-fw"></i> المخزن</a>
        </li>
    </ul>
@endsection

@section('content')

    <ul>
        <li style="margin-bottom: 5px">
            <a class="btn btn-primary" href="{{ route('user.create') }}" role="button">إضافة موظف</a>
        </li>
        <li style="margin-bottom: 5px">
            <a href="{{ route('user.createVendorFromCompanyAdmin') }}" class="btn btn-primary" role="button">إضافة مورد</a>
        </li>
        <li style="margin-bottom: 5px">
            <a href="{{ route('company.create') }}" class="btn btn-primary" role="button">إضافة عملية شراء</a>
        </li>
        <li style="margin-bottom: 5px">
            <a href="{{ route('company.create') }}" class="btn btn-primary" role="button">إضافة عملية بيع</a>
        </li>
    </ul>



@endsection
