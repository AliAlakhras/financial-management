@extends('layout.template')

@section('title','admin page')

@section('navbar')
    <div class="row align-items-center">
        <div class="col-lg-3 ml-auto">
            <form class="input-icon my-3 my-lg-0">
                <input type="search" class="form-control header-search" placeholder="Search&hellip;"
                       tabindex="1">
                <div class="input-icon-addon">
                    <i class="fe fe-search"></i>
                </div>
            </form>
        </div>
        <div class="col-lg order-lg-first">
            <ul class="nav nav-tabs border-0 flex-column flex-lg-row">
                <li class="nav-item">
                    <a href="{{ route('company.index') }}" class="nav-link"><i class="fe fe-home"></i> الشركات</a>
                </li>
            </ul>
        </div>
    </div>
@endsection

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">@lang('auth.register')</div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('user.storeUserFromAdminToCompany' , $company->id) }}">
                            @csrf
                            {{ method_field('put') }}
                            <div class="form-group">
                                <label for="name" class="col-md-4 col-form-label text-md">@lang('auth.name')</label>

                                <div class="col-md-6">
                                    <input id="name" type="text"
                                           class="form-control @error('name') is-invalid @enderror" name="name"
                                           value="{{ old('name') }}" required autocomplete="name" autofocus>

                                    @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group ">
                                <label for="email" class="col-md-4 col-form-label text-md">@lang('auth.email')</label>

                                <div class="col-md-6">
                                    <input id="email" type="email"
                                           class="form-control @error('email') is-invalid @enderror" name="email"
                                           value="{{ old('email') }}" required autocomplete="email">

                                    @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="email"
                                       class="col-md-4 col-form-label text-md">@lang('auth.role id')</label>

                                <div class="col-md-6">
                                    <select name="company_role_id" class="form-control" required>
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

                                </div>
                            </div>

                            <div class="form-group">
                                <label for="password"
                                       class="col-md-4 col-form-label text-md">@lang('auth.password')</label>

                                <div class="col-md-6">
                                    <input id="password" type="password"
                                           class="form-control @error('password') is-invalid @enderror" name="password"
                                           required autocomplete="new-password">

                                    @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="password-confirm"
                                       class="col-md-4 col-form-label text-md">@lang('auth.confirm password')</label>

                                <div class="col-md-6">
                                    <input id="password-confirm" type="password" class="form-control"
                                           name="password_confirmation" required autocomplete="new-password">
                                </div>
                            </div>

                            <div class="form-group mb-0">
                                <div class="col-md-6 ">
                                    <button type="submit" class="btn btn-primary">
                                        @lang('auth.register')
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
