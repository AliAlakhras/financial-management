@extends('layout.template')

@section('title','صفحة الشركة')

@section('title_content','إضافة مستخدم')
@section('sidebar')
    <ul class="nav" id="side-menu">
        <li>
            <a href="index.html"><i class="fa fa-dashboard fa-fw"></i> Dashboard</a>
        </li>
        <li>
            <a href="#"><i class="fa fa-bar-chart-o fa-fw"></i> Charts<span class="fa arrow"></span></a>
            <ul class="nav nav-second-level">
                <li>
                    <a href="flot.html">Flot Charts</a>
                </li>
                <li>
                    <a href="morris.html">Morris.js Charts</a>
                </li>
            </ul>
            <!-- /.nav-second-level -->
        </li>
    </ul>
@endsection
@section('content')
    <div class="col-md-8">
        <form class="form-signin" action="{{ route('user.store') }}" method="post">
            @csrf
            <h1 class="h3 mb-3 font-weight-normal">الرجاء إدخال بيانات المستخدم</h1>
            <input type="text" class="form-control" name="name" placeholder="@lang('auth.name')" required autofocus>
            <input type="email" class="form-control" name="email" placeholder="@lang('auth.email')" required>
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
            <input type="password" class="form-control" name="password" placeholder="@lang('auth.password')" required>
            <input type="password" class="form-control" name="password_confirmation" placeholder="@lang('auth.confirm password')" required>
            <div class="card-footer text-right">
                <button type="submit" class="btn btn-primary">@lang('auth.register')</button>
            </div>
        </form>
    </div>
@endsection
