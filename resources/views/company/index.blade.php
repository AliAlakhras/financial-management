@extends('layout.template')

@section('title','company page')

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
                    <a href="{{ route('user.employees') }}" class="nav-link">موظفين</a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('user.vendors') }}" class="nav-link">موردين</a>
                </li>
                <li class="nav-item">
                    <a href="" class="nav-link">المخزن</a>
                </li>
                <li class="nav-item">
                    <a href="" class="nav-link">عمليات الشراء</a>
                </li>
                <li class="nav-item">
                    <a href="" class="nav-link">عمليات البيع</a>
                </li>
            </ul>
        </div>
    </div>
@endsection

@section('content')


@endsection
