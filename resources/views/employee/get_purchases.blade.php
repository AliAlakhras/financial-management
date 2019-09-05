@extends('layout.template')

@section('title','صفحة المستخدم')

@section('title_content','المشتريات')

@section('sidebar')
    <ul class="nav" id="side-menu">
        <li>
            <a href="{{ route('user.employeePage') }}"><i class="fa fa-dashboard fa-fw"></i> صفحة المستخدم</a>
        </li>
        <li class="">
            <a href="#"><i class="fa fa-files-o fa-fw"></i> المصروفات<span class="fa arrow"></span></a>
            <ul class="nav nav-second-level">
                <li>
                    <a href="{{ route('expense.getExpensesForEmployee') }}">عرض المصروفات</a>
                </li>
                <li>
                    <a href="{{ route('expense.create') }}">إضافة مصروف</a>
                </li>
            </ul>
        </li>
        <li class="">
            <a href="#"><i class="fa fa-files-o fa-fw"></i>عمليات الشراء<span class="fa arrow"></span></a>
            <ul class="nav nav-second-level">
                <li>
                    <a href="{{ route('purchase.getPurchasesForEmployee') }}">عرض المشتريات</a>
                </li>
                <li>
                    <a href="{{ route('purchase.create') }}">إضافة عملية شراء</a>
                </li>
            </ul>
        </li>
        <li class="">
            <a href="#"><i class="fa fa-files-o fa-fw"></i>عمليات البيع<span class="fa arrow"></span></a>
            <ul class="nav nav-second-level">
                <li>
                    <a href="{{ route('sale.getSalesForEmployee') }}">عرض المبيعات</a>
                </li>
                <li>
                    <a href="{{ route('sale.create') }}">إضافة عملية بيع</a>
                </li>
            </ul>
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
                        <th scope="col" style="text-align: center;">المورد</th>
                        <th scope="col" style="text-align: center;">بتاريخ</th>
                        <th scope="col" style="text-align: center;">العمليات</th>
                    </tr>
                    </thead>
                    <tbody>
                    @if($purchases)
                        @foreach($purchases as $purchase)
                            <tr>
                                <th scope="row" style="text-align: center;">{{ $purchase->id }}</th>
                                @foreach($products as $product)
                                    @foreach($purchase->purchasedetailes as $purch)
                                        @if($product->id == $purch->product_id)
                                            <td>{{ $product->name }}</td>
                                        @endif
                                    @endforeach
                                @endforeach
                                @foreach($purchase->purchasedetailes as $purch)
                                    <td>{{ $purch->quantity }}</td>
                                @endforeach
                                @foreach($purchase->purchasedetailes as $purch)
                                    <td>{{ $purch->cost }}</td>
                                @endforeach
                                <td>{{ $purchase->total }}</td>
                                <td>{{ Illuminate\Support\Facades\Auth::user()->name  }}</td>
                                @foreach($users as $user)
                                    @if($user->id == $purchase->vendor_id)
                                        <td>{{ $user->name  }}</td>
                                    @endif
                                @endforeach
                                <td>{{ $purchase->created_at }}</td>
                                <td>
                                    <a href="{{ route('purchase.edit', $purchase->id) }}" class="btn btn-primary btn-sm"
                                       role="button">@lang('company.edit')</a>
                                    <form action="{{ route('purchase.destroy', $purchase->id) }}" method="post"
                                          style="display: inline">
                                        @csrf
                                        {{ method_field('delete') }}
                                        <button class="btn btn-danger btn-sm" type="submit">
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
                <h4 align="left"> مجموع المشتريات : {{ $total_purchases }}</h4>
            </div>
        </div>
    </div>
@endsection
@section('jsFooter')
    <script>
        $('#dataTables-example').dataTable();
    </script>
@endsection
