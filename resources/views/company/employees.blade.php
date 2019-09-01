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
            <a href="{{ route('wallet.index') }}"><i class="fa fa-dashboard fa-fw"></i> المحفظة</a>
        </li>
        <li>
            <a href="{{ route('expense.index') }}"><i class="fa fa-dashboard fa-fw"></i> المصروفات</a>
        </li>
        <li>
            <a href="{{ route('sale.index') }}"><i class="fa fa-dashboard fa-fw"></i> عمليات البيع</a>
        </li>
        <li>
            <a href="{{ route('purchase.index') }}"><i class="fa fa-dashboard fa-fw"></i> عمليات الشراء</a>
        </li>
        <li>
            <a href="{{ route('product.index') }}"><i class="fa fa-dashboard fa-fw"></i> المخزن</a>
        </li>
        <li>
            <a href="{{ route('debt.index') }}"><i class="fa fa-dashboard fa-fw"></i> الديون</a>
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
                                <td align="center">
                                    <a href="{{ route('user.edit', $employee->id) }}" class="btn btn-primary"
                                       role="button">@lang('company.edit')</a>
                                    <a href="{{ route('user.show', $employee->id) }}" class="btn btn-primary"
                                       role="button">عرض التفاصيل</a>
                                    <a href="{{ route('user.editPasswordFromCompanyAdmin', $employee->id) }}" class="btn btn-primary"
                                       role="button">تغيير كلمة المرور</a>
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
    <div class="panel panel-default">
        <div class="panel-body">
            <div class="table-responsive">
                <table class="table table-striped table-bordered table-hover" id="dataTables">
                    <thead>
                    <tr style="text-align: center;">
                        <th scope="col" style="text-align: center;">id</th>
                        <th scope="col" style="text-align: center;">name</th>
                        <th scope="col" style="text-align: center;">email</th>
                        <th scope="col" style="text-align: center;">action</th>
                    </tr>
                    </thead>
                    <tbody>

                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
@section('jsFooter')
    <script>
        $('#dataTables-example').dataTable();
        $(document).ready(function () {
            $('#dataTables').dataTable({
                serverSide: true,
                ajax: '{{ url('getEmployees') }}',
                columns: [
                    {data: 'id'},
                    {data: 'name'},
                    {data: 'email'},
                    {data: 'action'},
                ]
            });
        });
    </script>
@endsection
