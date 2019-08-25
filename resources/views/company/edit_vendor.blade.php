@extends('layout.template')

@section('title','صفحة الشركة')

@section('title_content','تعديل موظف')
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
    <div class="col-md-8">
        <form class="form-signin" action="{{ route('user.updateVendorFromCompanyAdmin' , $employee->id) }}" method="post">
            @csrf
            {{ method_field('put') }}
            <h1 class="h3 mb-3 font-weight-normal">الرجاء تعديل بيانات الموظف</h1>
            <input type="text" class="form-control" name="name" value="{{ $employee->name }}" placeholder="@lang('auth.name')" required autofocus>
            <input type="email" class="form-control" name="emailclass="btn btn-primary""  value="{{ $employee->email }}" placeholder="@lang('auth.email')" required>
            <div class="card-footer text-right">
                <button type="submit" class="btn btn-primary"> تعديل بيانات المورد </button>
            </div>
        </form>
    </div>
@endsection
