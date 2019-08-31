@extends('layout.template')

@section('title','صفحة المستخدم')

@section('title_content','المبيعات')

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
                        <th scope="col" style="text-align: center;">اسم المنتج</th>
                        <th scope="col" style="text-align: center;">الكمية</th>
                        <th scope="col" style="text-align: center;">التكلفة</th>
                        <th scope="col" style="text-align: center;">الإجمالي</th>
                        <th scope="col" style="text-align: center;">بواسطة</th>
                        <th scope="col" style="text-align: center;">بتاريخ</th>
                        <th scope="col" style="text-align: center;">العمليات</th>
                    </tr>
                    </thead>
                    <tbody>
                    @if($sales)
                        @foreach($sales as $sale)
                            <tr>
                                <th scope="row" style="text-align: center;">{{ $sale->id }}</th>
                                @foreach($products as $product)
                                    @if($product->id == $sale->product_id)
                                        <td>{{ $product->name }}</td>
                                    @endif
                                @endforeach
                                <td>{{ $sale->quantity }}</td>
                                <td>{{ $sale->cost }}</td>
                                <td>{{ $sale->total }}</td>
                                <td>{{ Illuminate\Support\Facades\Auth::user()->name  }}</td>
                                <td>{{ $sale->created_at }}</td>
                                <td>
                                    <a href="{{ route('sale.edit', $sale->id) }}" class="btn btn-primary"
                                       role="button">@lang('company.edit')</a>
                                    <form action="{{ route('sale.destroy', $sale->id) }}" method="post"
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
                            <td colspan="9">لا يوجد بيانات</td>
                        </tr>
                    @endif
                    </tbody>
                </table>
                <h4 align="left"> مجموع المبيعات : {{ $total_sales }}</h4>
            </div>
        </div>
    </div>
@endsection
@section('jsFooter')
    <script>
        $('#dataTables-example').dataTable();
    </script>
@endsection
