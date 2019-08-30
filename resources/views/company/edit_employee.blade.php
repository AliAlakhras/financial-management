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
        <form class="form-signin" action="" method="post">
            @csrf
            {{ method_field('put') }}
            <h1 class="h3 mb-3 font-weight-normal">الرجاء تعديل بيانات الموظف</h1>
            <input type="text" class="form-control" name="name" value="{{ $employee->name }}"
                   placeholder="@lang('auth.name')" required autofocus>
            <input type="email" class="form-control" name="email" value="{{ $employee->email }}"
                   placeholder="@lang('auth.email')" required>
            <select class="form-control" name="company_role_id" value="{{ $employee->company_role_id }}" required>
                <option value="-1">اختر نوع الموظف</option>
                @foreach($roles_company as $role)
                    @if($employee->company_role_id ==  $role->id )
                        <option value="{{ $role->id }}" selected>
                            @if($role->type == 'admin')
                                مسؤول
                            @else
                                @lang('auth.employee')
                            @endif
                        </option>
                    @endif
                @endforeach
            </select>
            <div class="card-footer text-right">
                <button type="submit" class="btn btn-primary">@lang('auth.register')</button>
            </div>
        </form>
    </div>
@endsection
