@extends('layout.template')

@section('title','صفحة المستخدم')

@section('title_content','المصروفات')

@section('sidebar')
    <ul class="nav" id="side-menu">
        <li>
            <a href="{{ route('user.employeePage') }}"><i class="fa fa-dashboard fa-fw"></i> صفحة المستخدم</a>
        </li>
        <li>
            <a href="{{ route('expense.getExpensesForEmployee') }}"><i class="fa fa-dashboard fa-fw"></i> المصروفات</a>
        </li>
        <li>
            <a href="{{ route('purchase.getPurchasesForEmployee') }}"><i class="fa fa-dashboard fa-fw"></i> عمليات الشراء</a>
        </li>
        <li>
            <a href="{{ route('sale.getSalesForEmployee') }}"><i class="fa fa-dashboard fa-fw"></i> عمليات البيع</a>
        </li>
        <li>
            <a href="{{ route('product.getProductsForEmployee') }}"><i class="fa fa-dashboard fa-fw"></i> المخزن</a>
        </li>
        <li>
            <a href="{{ route('debt.getDebtsForEmployee') }}"><i class="fa fa-dashboard fa-fw"></i> الديون</a>
        </li>
    </ul>
@endsection

@section('content')
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @elseif(session('fail'))
        <div class="alert alert-danger">
            {{ session('fail') }}
        </div>
    @endif
    <div class="panel panel-default">
        <div class="panel-body">
            <div class="table-responsive">
                <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                    <thead>
                    <tr style="text-align: center;">
                        <th scope="col" style="text-align: center;">م</th>
                        <th scope="col" style="text-align: center;">اسم المورد</th>
                        <th scope="col" style="text-align: center;">الإجمالي</th>
                        <th scope="col" style="text-align: center;">تم دفعه</th>
                        <th scope="col" style="text-align: center;">الباقي</th>
                        <th scope="col" style="text-align: center;">العمليات</th>
                    </tr>
                    </thead>
                    <tbody>
                    @if($purchases)
                        @foreach($purchases as $purchase)
                            @foreach($purchase->debts as $debt)
                                <tr>
                                    <th scope="row" style="text-align: center;">{{ $debt->id }}</th>
                                    @foreach($users as $user)
                                        @if($user->id == $purchase->vendor_id)
                                            <td>{{ $user->name }}</td>
                                        @endif
                                    @endforeach
                                    <td>{{ $debt->paid + $debt->due }}</td>
                                    <td>{{ $debt->paid }}</td>

                                    <td>{{ $debt->due }}</td>
                                    <td>
                                        <a href="{{ route('debt.edit', $debt->id) }}" class="btn btn-primary"
                                           role="button">@lang('company.edit')</a>
                                        <form action="{{ route('debt.destroy', $debt->id) }}" method="post"
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
                        @endforeach
                    @else
                        <tr>
                            <td colspan="6">لا يوجد بيانات</td>
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
