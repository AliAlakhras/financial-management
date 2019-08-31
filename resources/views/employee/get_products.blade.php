@extends('layout.template')

@section('title','صفحة المستخدم')

@section('title_content','المخزن')

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
    <div class="panel panel-default">
        <div class="panel-body">
            <div class="table-responsive">
                <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                    <thead>
                    <tr style="text-align: center;">
                        <th scope="col" style="text-align: center;">م</th>
                        <th scope="col" style="text-align: center;">الاسم</th>
                        <th scope="col" style="text-align: center;">الكمية</th>
                        <th scope="col" style="text-align: center;">التكلفة</th>
                        <th scope="col" style="text-align: center;">المبلغ</th>
                        <th scope="col" style="text-align: center;">بتاريخ</th>
                    </tr>
                    </thead>
                    <tbody>
                    @if($products)
                        @foreach($products as $product)
                            <tr>
                                <th scope="row" style="text-align: center;">{{ $product->id }}</th>
                                <td>{{ $product->name }}</td>
                                <td>{{ $product->quantity  }}</td>
                                <td>{{ $product->cost  }}</td>
                                <td>{{ $product->total  }}</td>
                                <td>{{ $product->created_at  }}</td>
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
