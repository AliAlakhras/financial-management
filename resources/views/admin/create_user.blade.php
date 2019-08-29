@extends('layout.template')

@section('title','صفحة الأدمن')

@section('title_content','إضافة مستخدم للشركة')
@section('sidebar')
    <ul class="nav" id="side-menu">
        <li>
            <a href="{{ route('company.index') }}"><i class="fa fa-dashboard fa-fw"></i> الشركات</a>
        </li>
    </ul>
@endsection
@section('content')
    <div class="col-md-8">
        <form class="form-signin" action="{{ route('user.storeUserFromAdminToCompany' , $company->id) }}" method="post">
            @csrf
            {{ method_field('put') }}
            <h1 class="h3 mb-3 font-weight-normal">الرجاء إدخال بيانات الشركة</h1>

            <input type="text" class="form-control" name="name" placeholder="@lang('auth.name')" required autofocus>
            <input type="email" class="form-control" name="email" placeholder="@lang('auth.email')" required>
            <select class="form-control" name="company_role_id" required>
                <option value="-1">@lang('auth.choose')</option>
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

