@extends('layout.template')

@section('title','صفحة الشركة')

@section('title_content','المبيعات')

@section('sidebar')
    <ul class="nav in" id="side-menu">
        <li>
            <a href="{{ route('user.index') }}"><i class="fa fa-dashboard fa-fw"></i> الشركة</a>
        </li>
        <li class="">
            <a href="#"><i class="fa fa-files-o fa-fw"></i> الموظفين<span class="fa arrow"></span></a>
            <ul class="nav nav-second-level">
                <li>
                    <a href="{{ route('user.employees') }}">عرض الموظفين</a>
                </li>
                <li>
                    <a href="{{ route('user.create') }}">إضافة موظف</a>
                </li>
            </ul>
        </li>
        <li class="">
            <a href="#"><i class="fa fa-files-o fa-fw"></i> الموردين<span class="fa arrow"></span></a>
            <ul class="nav nav-second-level">
                <li>
                    <a href="{{ route('user.vendors') }}">عرض الموردين</a>
                </li>
                <li>
                    <a href="{{ route('user.createVendorFromCompanyAdmin') }}">إضافة مورد</a>
                </li>
            </ul>
        </li>
        <li class="">
            <a href="#"><i class="fa fa-files-o fa-fw"></i> المحفظة<span class="fa arrow"></span></a>
            <ul class="nav nav-second-level">
                <li>
                    <a href="{{ route('wallet.index') }}">عرض </a>
                </li>
                <li>
                    <a href="{{ route('wallet.create') }}">إضافة رصيد</a>
                </li>
            </ul>
        </li>
        <li class="">
            <a href="#"><i class="fa fa-files-o fa-fw"></i> المصروفات<span class="fa arrow"></span></a>
            <ul class="nav nav-second-level">
                <li>
                    <a href="{{ route('expense.index') }}">عرض المصروفات</a>
                </li>
                <li>
                    <a href="{{ route('expense.create') }}">إضافة مصروف</a>
                </li>
            </ul>
        </li>
        <li class="">
            <a href="#"><i class="fa fa-files-o fa-fw"></i>عمليات البيع<span class="fa arrow"></span></a>
            <ul class="nav nav-second-level">
                <li>
                    <a href="{{ route('sale.index') }}">عرض المبيعات</a>
                </li>
                <li>
                    <a href="{{ route('sale.create') }}">إضافة عملية بيع</a>
                </li>
            </ul>
        </li>
        <li class="">
            <a href="#"><i class="fa fa-files-o fa-fw"></i>عمليات الشراء<span class="fa arrow"></span></a>
            <ul class="nav nav-second-level">
                <li>
                    <a href="{{ route('purchase.index') }}">عرض المشتريات</a>
                </li>
                <li>
                    <a href="{{ route('purchase.create') }}">إضافة عملية شراء</a>
                </li>
            </ul>
        </li>
        <li class="">
            <a href="#"><i class="fa fa-files-o fa-fw"></i>المخزن<span class="fa arrow"></span></a>
            <ul class="nav nav-second-level">
                <li>
                    <a href="{{ route('product.index') }}">عرض</a>
                </li>
                <li>
                    <a href="{{ route('product.create') }}">إضافة منتج</a>
                </li>
            </ul>
        </li>
        <li>
            <a href="{{ route('debt.index') }}"><i class="fa fa-dashboard fa-fw"></i> الديون</a>
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
                                @foreach($users as $user)
                                    @if($user->id == $sale->user_id)
                                        <td>{{ $user->name  }}</td>
                                    @endif
                                @endforeach
                                <td>{{ $sale->created_at }}</td>
                                <td>
                                    <a href="{{ route('sale.edit', $sale->id) }}" class="btn btn-primary btn-sm"
                                       role="button">@lang('company.edit')</a>
                                    <form action="{{ route('sale.destroy', $sale->id) }}" method="post"
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
