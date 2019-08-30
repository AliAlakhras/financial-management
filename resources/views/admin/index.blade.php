@extends('layout.template')

@section('title','صفحة الأدمن')
@section('title_content','الشركات')
@section('sidebar')
    <ul class="nav" id="side-menu">
        <li>
            <a href="{{ route('company.index') }}"><i class="fa fa-dashboard fa-fw"></i> الشركات</a>
        </li>
    </ul>
@endsection
@section('content')
    <div class="panel panel-default">
        <div class="panel-body">
            <div class="table-responsive">
                <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                    <thead>
                    <tr style="text-align: center;">
                        <th scope="col" style="text-align: center;">@lang('company.id')</th>
                        <th scope="col" style="text-align: center;">@lang('company.name')</th>
                        <th scope="col" style="text-align: center;">@lang('company.type')</th>
                        <th scope="col" style="text-align: center;">@lang('company.address')</th>
                        <th scope="col" style="text-align: center;">@lang('company.phone')</th>
                        <th scope="col" style="text-align: center;">@lang('company.email')</th>
                        <th scope="col" style="text-align: center;">@lang('company.action')</th>
                    </tr>
                    </thead>
                    <tbody>
                    @if($companies)
                        @foreach($companies as $company)
                            <tr>

                                <th scope="row" style="text-align: center;">{{ $company->id }}</th>
                                <td>{{ $company->name  }}</td>
                                <td>{{ $company->type  }}</td>
                                <td>{{ $company->address  }}</td>
                                <td>{{ $company->phone  }}</td>
                                <td>{{ $company->email  }}</td>
                                <td>
                                    <a href="{{ route('company.edit', $company->id) }}" class="btn btn-primary"
                                       role="button">@lang('company.edit')</a>
                                    <a href="{{ route('user.createUserFromAdminToCompany', $company->id)}}"
                                       class="btn btn-primary" role="button">إضافة مسؤول</a>
                                    <form action="{{ route('company.destroy',$company->id) }}" method="post"
                                          style="display: inline">
                                        @csrf
                                        {{ method_field('delete') }}
                                        <button class="btn btn-danger" type="submit">
                                            @lang('company.delete')
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    @else
                        <tr>
                            <td colspan="6">No data</td>
                        </tr>
                    @endif
                    </tbody>
                </table>
                <div align="left">
                    <a href="{{ route('company.create') }}" class="btn btn-primary"
                       role="button">@lang('company.add')</a>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('jsFooter')
    <script>
        $('#dataTables-example').dataTable();
    </script>
@endsection
