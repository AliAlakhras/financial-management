@extends('layout.template')

@section('title','صفحة الأدمن')

@section('title_content','إضافة شركة')
@section('sidebar')
    <ul class="nav" id="side-menu">
        <li>
            <a href="{{ route('company.index') }}"><i class="fa fa-dashboard fa-fw"></i> الشركات</a>
        </li>
    </ul>
@endsection
@section('content')
    <div class="col-md-8">
    <form class="form-signin" action="{{ route('company.store') }}" method="post">
        @csrf
        <h1 class="h3 mb-3 font-weight-normal">الرجاء إدخال بيانات الشركة</h1>

        <input type="text" class="form-control" name="name" placeholder="@lang('company.name')" required autofocus>
        @error('name')
        <div class="alert alert-danger">{{ $message }}</div>
        @enderror
        <input type="text" class="form-control" name="type" placeholder="@lang('company.type')" required>
        @error('type')
        <div class="alert alert-danger">{{ $message }}</div>
        @enderror
        <input type="text" class="form-control" name="address" placeholder="@lang('company.address')" required>
        @error('address')
        <div class="alert alert-danger">{{ $message }}</div>
        @enderror
        <input type="text" class="form-control" name="phone" placeholder="@lang('company.phone')" required>
        @error('phone')
        <div class="alert alert-danger">{{ $message }}</div>
        @enderror
        <input type="email" class="form-control" name="email" placeholder="@lang('company.email')" required>
        @error('email')
        <div class="alert alert-danger">{{ $message }}</div>
        @enderror

        <div class="card-footer text-right">
            <button type="submit" class="btn btn-primary">@lang('company.add')</button>
        </div>
    </form>
    </div>
@endsection
