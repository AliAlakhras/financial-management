@extends('layout.template')

@section('title','صفحة الشركة')

@section('title_content','عرض التفاصيل')

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
    <div class="col-lg-6">
        <div class="panel panel-default">
            <div class="panel-heading"> معلومات عملية الشراء</div>
            <div class="panel-body">
                <div class="table-responsive">
                    <table class="table table-striped table-bordered table-hover">
                        @foreach($purchases as $purchase)
                            <tr>
                                <th>اسم المنتج</th>
                                @foreach($products as $product)
                                    @foreach($purchase->purchasedetailes as $purch)
                                        @if($product->id == $purch->product_id)
                                            <td>{{ $product->name }}</td>
                                        @endif
                                    @endforeach
                                @endforeach
                            </tr>
                            <tr>
                                <th>الكمية</th>
                                <td>{{ $purch->quantity }}</td>
                            </tr>
                            <tr>
                                <th>التكلفة</th>
                                <td>{{ $purch->cost }}</td>
                            </tr>
                        @endforeach
                        <tr>
                            <th>الإجمالي</th>
                            <td>{{ $purchase->total }}</td>
                        </tr>
                        <tr>
                            <th>تم دفعه</th>
                            <td>{{ $debt->paid }}</td>
                        </tr>
                        <tr>
                            <th>الباقي</th>
                            <td>{{ $debt->due }}</td>
                        </tr>
                        <tr>
                            <th>بواسطة</th>
                            @foreach($users as $user)
                                @if($user->id == $purchase->user_id)
                                    <td>{{ $user->name  }}</td>
                                @endif
                            @endforeach
                        </tr>
                        <tr>
                            <th>اسم المورد</th>
                            @if($user->id == $purchase->vendor_id)
                                <td>{{ $user->name  }}</td>
                            @endif
                        </tr>
                        <tr>
                            <th>بتاريخ</th>
                            <td>{{ $purchase->created_at }}</td>
                        </tr>
                    </table>
                </div>
            </div>
            <div class="panel-heading" align="center">
                <a href="{{ route('purchase.edit', $purchase->id) }}" class="btn btn-primary btn-sm"
                   role="button">دفع دفعة</a>
                <a href="{{ route('purchase.edit', $purchase->id) }}" class="btn btn-primary btn-sm"
                   role="button">طباعة فاتورة</a>
            </div>
        </div>
    </div>
@endsection