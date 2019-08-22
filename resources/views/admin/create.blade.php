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
    <div class="page-header">
        <h1 class="page-title">
            @lang('company.add')
        </h1>
    </div>

    <div class="row">
        <div class="col">
            <form class="card" action="{{ route('company.store') }}" method="post">
                @csrf
                <div class="card-body">
                    <div class="row">
                        <div class="col">
                            <div class="form-group">
                                <label class="form-label">@lang('company.name')</label>
                                <input type="text" class="form-control" name="name" placeholder="@lang('company.name')" required>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <div class="form-group">
                                <label class="form-label">@lang('company.type')</label>
                                <input type="text" class="form-control" name="type" placeholder="@lang('company.type')" required>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <div class="form-group">
                                <label class="form-label">@lang('company.address')</label>
                                <input type="text" class="form-control" name="address" placeholder="@lang('company.address')" required>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <div class="form-group">
                                <label class="form-label">@lang('company.phone')</label>
                                <input type="text" class="form-control" name="phone" placeholder="@lang('company.phone')" required>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <div class="form-group">
                                <label class="form-label">@lang('company.email')</label>
                                <input type="email" class="form-control" name="email" placeholder="@lang('company.email')" required>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-footer text-right">
                    <button type="submit" class="btn btn-primary">@lang('company.add')</button>
                </div>
            </form>
        </div>
    </div>
@endsection
