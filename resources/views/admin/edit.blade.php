@extends('layout.template')

@section('title','صفحة الأدمن')

@section('title_content','الشركات')

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
        <form class="form-signin" action="{{ route('company.update' , $company->id) }}" method="post">
            @csrf
            {{ method_field('put') }}
            <h1 class="h3 mb-3 font-weight-normal">الرجاء إدخال بيانات الشركة</h1>

            <input type="text" class="form-control" name="name" placeholder="@lang('company.name')" value="{{ $company->name }}" required autofocus>
            <input type="text" class="form-control" name="type" placeholder="@lang('company.type')" value="{{ $company->type }}" required>
            <input type="text" class="form-control" name="address" placeholder="@lang('company.address')"  value="{{ $company->address }}" required>
            <input type="text" class="form-control" name="phone" placeholder="@lang('company.phone')"  value="{{ $company->phone }}" required>
            <input type="email" class="form-control" name="email" placeholder="@lang('company.email')"  value="{{ $company->email }}" required>

            <div class="card-footer text-right">
                <button type="submit" class="btn btn-primary">@lang('company.add')</button>
            </div>
        </form>
    </div>
@endsection

@section('content')


    <div class="row">
        <div class="col">
            <form class="card" action="{{ route('company.update' , $company->id) }}" method="post">
                @csrf
                {{ method_field('put') }}
                <div class="card-body">
                    <div class="row">
                        <div class="col">
                            <div class="form-group">
                                <label class="form-label">@lang('company.name')</label>
                                <input type="text" value="{{ $company->name }}" class="form-control" name="name" placeholder="@lang('company.name')" required>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <div class="form-group">
                                <label class="form-label">@lang('company.type')</label>
                                <input type="text" value="{{ $company->type }}" class="form-control" name="type" placeholder="@lang('company.type')" required>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <div class="form-group">
                                <label class="form-label">@lang('company.address')</label>
                                <input type="text" value="{{ $company->address }}"  class="form-control" name="address" placeholder="@lang('company.address')" required>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <div class="form-group">
                                <label class="form-label">@lang('company.phone')</label>
                                <input type="text" value="{{ $company->phone }}" class="form-control" name="phone" placeholder="@lang('company.phone')" required>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <div class="form-group">
                                <label class="form-label">@lang('company.email')</label>
                                <input type="email" value="{{ $company->email }}" class="form-control" name="email" placeholder="@lang('company.email')" required>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-footer text-right">
                    <button type="submit" class="btn btn-primary">@lang('company.edit')</button>
                </div>
            </form>
        </div>
    </div>
@endsection
