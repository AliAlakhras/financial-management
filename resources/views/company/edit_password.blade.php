@extends('layout.template')

@section('title','صفحة الشركة')
@section('title_content','الموظفين')

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
        <form class="form-signin" action="{{ route('user.updatePasswordFromCompanyAdmin', $employee->id) }}" method="post">
            @csrf
            {{ method_field('put') }}
            <input type="password" class="form-control" name="password" placeholder="كلمة المرور الجديدة" required>
            @error('password')
            <div class="alert alert-danger">{{ $message }}</div>
            @enderror
            <input type="password" class="form-control" name="password_confirmation" placeholder="تأكيد كلمة المرور الجديدة" required>
            @error('password_confirmation')
            <div class="alert alert-danger">{{ $message }}</div>
            @enderror
            <div class="card-footer text-right">
                <button type="submit" class="btn btn-primary">تعديل كلمة المرور</button>
            </div>
        </form>
    </div>
@endsection
