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
    <form class="form-signin" action="{{ route('company.store') }}" method="post">
        @csrf
        <h1 class="h3 mb-3 font-weight-normal">الرجاء إدخال بيانات الشركة</h1>

        <input type="text" class="form-control" name="name" placeholder="@lang('company.name')" required autofocus>
        <input type="text" class="form-control" name="type" placeholder="@lang('company.type')" required>
        <input type="text" class="form-control" name="address" placeholder="@lang('company.address')" required>
        <input type="text" class="form-control" name="phone" placeholder="@lang('company.phone')" required>
        <input type="email" class="form-control" name="email" placeholder="@lang('company.email')" required>

        <div class="card-footer text-right">
            <button type="submit" class="btn btn-primary">@lang('company.add')</button>
        </div>
    </form>
    </div>
@endsection
