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
                    <a href="{{ route('company.index') }}" class="nav-link">الشركات</a>
                </li>
            </ul>
        </div>
    </div>
@endsection

@section('content')
    <div class="page-header">
        <h1 class="page-title">
            @lang('company.title')
        </h1>

        <a href="{{ route('company.create') }}" class="btn btn-primary" role="button">@lang('company.add')</a>

    </div>
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <div class="text-wrap p-lg-6">
                        <table class="table">
                            <tr>
                                <th>@lang('company.id')</th>
                                <th>@lang('company.name')</th>
                                <th>@lang('company.type')</th>
                                <th>@lang('company.address')</th>
                                <th>@lang('company.phone')</th>
                                <th>@lang('company.email')</th>
                                <th>@lang('company.action')</th>
                            </tr>
                            @if($companies)
                                @foreach($companies as $company)
                                    <tr>
                                        <td>{{ $company->id }}</td>
                                        <td>{{ $company->name }}</td>
                                        <td>{{ $company->type }}</td>
                                        <td>{{ $company->address }}</td>
                                        <td>{{ $company->phone }} </td>
                                        <td>{{ $company->email }} </td>
                                        <th>
                                            <a href="{{ route('company.edit', $company->id) }}" class="btn btn-primary" role="button">@lang('company.edit')</a>
                                            <a href="{{ route('user.createUserFromAdminToCompany', $company->id)}}" class="btn btn-primary" role="button">إضافة مسؤول</a>
                                            <form action="{{ route('company.destroy',$company->id) }}" method="post" style="display: inline">
                                                @csrf
                                                {{ method_field('delete') }}
                                                <button class="btn btn-danger" type="submit">
                                                    @lang('company.delete')
                                                </button>
                                            </form>
                                        </th>
                                    </tr>
                                @endforeach
                            @else
                                <tr>
                                    <td colspan="6">No data</td>
                                </tr>
                            @endif
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
