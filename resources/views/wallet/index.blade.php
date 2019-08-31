@extends('layout.template')

@section('title','صفحة الشركة')

@section('title_content','المحفظة')

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
                        <th scope="col" style="text-align: center;">م</th>
                        <th scope="col" style="text-align: center;">النوع</th>
                        <th scope="col" style="text-align: center;">المبلغ</th>
                        <th scope="col" style="text-align: center;">بواسطة</th>
                        <th scope="col" style="text-align: center;">بتاريخ</th>
                        <th scope="col" style="text-align: center;">العمليات</th>
                    </tr>
                    </thead>
                    <tbody>
                    @if($wallets)
                        @foreach($wallets as $wallet)
                            <tr>
                                <th scope="row" style="text-align: center;">{{ $wallet->id }}</th>
                                <td>{{ $wallet->type }}</td>
                                <td>{{ $wallet->income  }}</td>
                                @foreach($users as $user)
                                    @if($user->id == $wallet->user_id)
                                    <td>{{ $user->name  }}</td>
                                    @endif
                                @endforeach
                                <td>{{ $wallet->created_at  }}</td>
                                <td>
                                    <a href="{{ route('wallet.edit', $wallet->id) }}" class="btn btn-primary"
                                       role="button">@lang('company.edit')</a>
                                    <form action="{{ route('wallet.destroy', $wallet->id) }}" method="post"
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
            </div>
        </div>
    </div>
@endsection
@section('jsFooter')
    <script>
        $('#dataTables-example').dataTable();
    </script>
@endsection
