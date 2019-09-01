@extends('layout.template')

@section('title','صفحة الشركة')

@section('title_content','إضافة مستخدم')
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
        <form class="form-signin" action="{{ route('user.store') }}" method="post">
            @csrf
            <h1 class="h3 mb-3 font-weight-normal">الرجاء إدخال بيانات المستخدم</h1>
            <input type="text" class="form-control" name="name" placeholder="@lang('auth.name')" required autofocus>
            @error('name')
            <div class="alert alert-danger">{{ $message }}</div>
            @enderror
            <input type="email" class="form-control" name="email" placeholder="@lang('auth.email')" required>
            @error('email')
            <div class="alert alert-danger">{{ $message }}</div>
            @enderror
            <select class="form-control" name="company_role_id" required>
                <option value="-1">اختر نوع الموظف</option>
                @foreach($roles_company as $role)
                    <option value="{{ $role->id }}">
                        @if($role->type == 'admin')
                            مسؤول
                        @else
                            @lang('auth.employee')
                        @endif
                    </option>
                @endforeach
            </select>
            @error('company_role_id')
            <div class="alert alert-danger">{{ $message }}</div>
            @enderror
            <input type="password" class="form-control" name="password" placeholder="@lang('auth.password')" required>
            @error('password')
            <div class="alert alert-danger">{{ $message }}</div>
            @enderror
            <input type="password" class="form-control" name="password_confirmation"
                   placeholder="@lang('auth.confirm password')" required>
            @error('password_confirmation')
            <div class="alert alert-danger">{{ $message }}</div>
            @enderror
            <div class="card-footer text-right">
                <button type="submit" class="btn btn-primary">@lang('auth.register')</button>
            </div>
        </form>
    </div>
@endsection
