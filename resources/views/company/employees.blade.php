@extends('layout.template')

@section('title','صفحة الشركة')
@section('title_content','الموظفين')

@section('sidebar')
    <ul class="nav" id="side-menu">
        <li>
            <a href="{{ route('user.index') }}"><i class="fa fa-dashboard fa-fw"></i> الشركة</a>
        </li>
        <li>
            <a href="{{ route('user.employees') }}"><i class="fa fa-dashboard fa-fw"></i> الموظفين</a>
        </li>
        <li>
            <a href="{{ route('user.vendors') }}"><i class="fa fa-dashboard fa-fw"></i> الموردين</a>
        </li>
        <li>
            <a href="index.html"><i class="fa fa-dashboard fa-fw"></i> عمليات البيع</a>
        </li>
        <li>
            <a href="index.html"><i class="fa fa-dashboard fa-fw"></i> عمليات الشراء</a>
        </li>
        <li>
            <a href="index.html"><i class="fa fa-dashboard fa-fw"></i> المخزن</a>
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
                        <th scope="col" style="text-align: center;">@lang('company.email')</th>
                        <th scope="col" style="text-align: center;">@lang('company.role_id')</th>
                        <th scope="col" style="text-align: center;">@lang('company.action')</th>
                    </tr>
                    </thead>
                    <tbody>
                    @if($employees)
                        @foreach($employees as $employee)
                    <tr>

                                <th scope="row" style="text-align: center;">{{ $employee->id }}</th>
                                <td>{{ $employee->name  }}</td>
                                <td>{{ $employee->email  }}</td>
                                <td>{{ $employee->company_role_id  }}</td>
                                <td>
                                    <a href="{{ route('user.edit', $employee->id) }}" class="btn btn-primary"
                                       role="button">@lang('company.edit')</a>
                                    <form action="{{ route('user.destroy',$employee->id) }}" method="post"
                                          style="display: inline">
                                        @csrf
                                        {{ method_field('delete') }}
                                        <button class="btn btn-danger" type="submit">
                                            @lang('company.delete')
                                        </button>
                                    </form>
                                </td>
                            @endforeach
                    </tr>

                    @else
                        <tr>
                            <td colspan="6">No data</td>
                        </tr>
                    @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
